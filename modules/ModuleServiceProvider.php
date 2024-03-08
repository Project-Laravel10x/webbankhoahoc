<?php

namespace Modules;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Modules\User\src\Repositories\UserRepository;


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

        $this->app->singleton(
            UserRepository::class
        );

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


        if (File::exists($modulePath . "routes/web.php")) {
            $this->loadRoutesFrom($modulePath . "routes/web.php");
        }

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
}
