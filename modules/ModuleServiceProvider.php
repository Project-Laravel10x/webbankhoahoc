<?php

namespace Modules;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Categories\src\Repositories\CategoriesRepository;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;
use Modules\Courses\src\Repositories\CoursesRepository;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Document\src\Repositories\DocumentRepository;
use Modules\Document\src\Repositories\DocumentRepositoryInterface;
use Modules\Lessons\src\Repositories\LessonsRepository;
use Modules\Lessons\src\Repositories\LessonsRepositoryInterface;
use Modules\NewsCategories\src\Repositories\NewsCategoriesRepository;
use Modules\NewsCategories\src\Repositories\NewsCategoriesRepositoryInterface;
use Modules\Orders\src\Repositories\OrderRepository;
use Modules\Orders\src\Repositories\OrderRepositoryInterface;
use Modules\OrdersDetail\src\Repositories\OrderDetailRepository;
use Modules\OrdersDetail\src\Repositories\OrderDetailRepositoryInterface;
use Modules\Students\src\Repositories\StudentRepository;
use Modules\Students\src\Repositories\StudentRepositoryInterface;
use Modules\Teacher\src\Repositories\TeacherRepository;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;
use Modules\User\src\Repositories\UserRepository;
use Modules\User\src\Repositories\UserRepositoryInterface;
use Modules\Video\src\Repositories\VideoRepository;
use Modules\Video\src\Repositories\VideoRepositoryInterface;


class ModuleServiceProvider extends ServiceProvider
{
    private array $middlewares = [

    ];

    private array $commands = [

    ];

    public function boot()
    {
        $module = $this->getModules();

        if (!empty($module)) {
            foreach ($module as $directory) {
                $this->registerModule($directory);
            }
        }

    }

    public function register()
    {
        $module = $this->getModules();

        if (!empty($module)) {
            foreach ($module as $directory) {
                $this->registerConfig($directory);
            }
        }

        $this->registerMiddleware();

        $this->bindingsRepository();

        $this->commands($this->commands);
    }

    private function getModules(): array
    {
        return array_map("basename", File::directories(__DIR__));
    }

    private function registerConfig($module)
    {
        $modulePath = __DIR__ . "/$module/configs";
        $configFile = array_map("basename", File::allFiles($modulePath));
        foreach ($configFile as $file) {
            $alias = basename($file, ".php");
            $this->mergeConfigFrom($modulePath . "/$file", $alias);
        }
    }

    private function registerMiddleware()
    {
        if (!empty($this->middlewares)) {
            foreach ($this->middlewares as $key => $middleware) {
                $this->app['router']->pushMiddlewareToGroup($key, $middleware);
            }
        }
    }

    private function registerModule($module)
    {
        $modulePath = __DIR__ . "/$module/";

        Route::group(['middleware' => 'web', 'namespace' => 'Modules\\' . $module . '\src\Http\Controllers\Auth'],
            function () use ($modulePath) {
                if (File::exists($modulePath . "routes/web.php")) {
                    $this->loadRoutesFrom($modulePath . "routes/web.php");
                }
            });

        Route::group(['middleware' => 'api', 'prefix' => 'api'], function () use ($modulePath) {
            if (File::exists($modulePath . "routes/api.php")) {
                $this->loadRoutesFrom($modulePath . "routes/api.php");
            }
        });


        if (File::exists($modulePath . "migrations")) {
            $this->loadMigrationsFrom($modulePath . "migrations");
        }

        if (File::exists($modulePath . "resources/views")) {
            $this->loadViewsFrom($modulePath . "resources/views", strtolower($module));
        }
        if (File::exists($modulePath . "resources/lang")) {
            $this->loadTranslationsFrom($modulePath . "resources/lang", strtolower($module));
        }
        if (File::exists($modulePath . "helpers")) {
            $listFile = File::allFiles($modulePath . "helpers");
            if (!empty($listFile)) {
                foreach ($listFile as $file) {
                    $file = $file->getPathname();
                    require_once $file;
                }
            }
        }
    }

    private function bindingsRepository()
    {
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class,
        );

        $this->app->singleton(
            TeacherRepositoryInterface::class,
            TeacherRepository::class,
        );

        $this->app->singleton(
            CategoriesRepositoryInterface::class,
            CategoriesRepository::class,
        );

        $this->app->singleton(
            CoursesRepositoryInterface::class,
            CoursesRepository::class,
        );
        $this->app->singleton(
            VideoRepositoryInterface::class,
            VideoRepository::class,
        );
        $this->app->singleton(
            DocumentRepositoryInterface::class,
            DocumentRepository::class,
        );
        $this->app->singleton(
            LessonsRepositoryInterface::class,
            LessonsRepository::class,
        );
        $this->app->singleton(
            NewsCategoriesRepositoryInterface::class,
            NewsCategoriesRepository::class,
        );
        $this->app->singleton(
            StudentRepositoryInterface::class,
            StudentRepository::class,
        );
        $this->app->singleton(
            OrderRepositoryInterface::class,
            OrderRepository::class,
        );
        $this->app->singleton(
            OrderDetailRepositoryInterface::class,
            OrderDetailRepository::class,
        );
    }
}
