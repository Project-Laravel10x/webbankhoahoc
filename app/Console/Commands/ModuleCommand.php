<?php

namespace App\Console\Commands;

use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Modules\User\src\Models\User;
use Modules\User\src\Repositories\UserRepositoryInterface;


class ModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module  {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $name = $this->argument('name');

        if (File::exists(base_path('modules/' . $name))) {
            $this->error("Module exists already !");
        } else {
            File::makeDirectory(base_path('modules/' . $name), 0755, true, true);

            $configFolder = base_path('modules/' . $name . '/configs');

            if (!File::exists($configFolder)) {
                File::makeDirectory($configFolder, 0755, true, true);
            }


            $helperFolder = base_path('modules/' . $name . '/helpers');

            if (!File::exists($helperFolder)) {
                File::makeDirectory($helperFolder, 0755, true, true);
            }


            $migrationFolder = base_path('modules/' . $name . '/migrations');

            if (!File::exists($migrationFolder)) {
                File::makeDirectory($migrationFolder, 0755, true, true);
            }


            $resourceFolder = base_path('modules/' . $name . '/resources');

            if (!File::exists($resourceFolder)) {
                File::makeDirectory($resourceFolder, 0755, true, true);
                $lang = base_path('modules/' . $name . '/resources/lang');
                $views = base_path('modules/' . $name . '/resources/views');
                if (!File::exists($lang)) {
                    File::makeDirectory($lang, 0755, true, true);
                }
                if (!File::exists($views)) {
                    File::makeDirectory($views, 0755, true, true);
                }
            }


            $routesFolder = base_path('modules/' . $name . '/routes');

            if (!File::exists($routesFolder)) {
                File::makeDirectory($routesFolder, 0755, true, true);
                $fileFolder = base_path('modules/' . $name . '/routes/web.php');
                if (!File::exists($fileFolder)) {
                    File::put($fileFolder,
                        "<?php
                                use Illuminate\Support\Facades\Route;

                                Route::get('/', function () {
                                    return view('welcome');
                                });
                                ");
                }
            }


            $srcFolder = base_path('modules/' . $name . '/src');

            if (!File::exists($srcFolder)) {
                File::makeDirectory($srcFolder, 0755, true, true);
                $commandFolder = base_path('modules/' . $name . '/src/Commands');
                $repositoriesFolder = base_path('modules/' . $name . '/src/Repositories');
                $httpFolder = base_path('modules/' . $name . '/src/Http');
                $modelFolder = base_path('modules/' . $name . '/src/Models');
                $controllerFolder = base_path('modules/' . $name . '/src/Http/Controllers');
                $middlewareFolder = base_path('modules/' . $name . '/src/Http/Middlewares');

                if (!File::exists($commandFolder)) {
                    File::makeDirectory($commandFolder, 0755, true, true);
                }
                if (!File::exists($repositoriesFolder)) {
                    File::makeDirectory($repositoriesFolder, 0755, true, true);
                    $fileRepo = base_path('modules/' . $name . '/src/Repositories/' . $name . 'Repository.php');
                    $fileRepoInterface = base_path('modules/' . $name . '/src/Repositories/' . $name . 'RepositoryInterface.php');

                    if (!File::exists($fileRepo)) {
                        File::put($fileRepo,
                            '<?php
namespace Modules\\' . $name . '\src\Repositories;

use App\Repositories\BaseRepository;

class ' . $name . 'Repository extends BaseRepository implements ' . $name . 'RepositoryInterface
{

}

                                ');
                    }
                    if (!File::exists($fileRepoInterface)) {
                        File::put($fileRepoInterface,
                            '<?php
namespace Modules\\' . $name . '\src\Repositories;

use  App\Repositories\RepositoryInterface;

interface ' . $name . 'RepositoryInterface extends RepositoryInterface
{

}
');
                    }
                }
                if (!File::exists($httpFolder)) {
                    File::makeDirectory($httpFolder, 0755, true, true);
                }
                if (!File::exists($modelFolder)) {
                    File::makeDirectory($modelFolder, 0755, true, true);
                }
                if (!File::exists($controllerFolder)) {
                    File::makeDirectory($controllerFolder, 0755, true, true);
                }
                if (!File::exists($middlewareFolder)) {
                    File::makeDirectory($middlewareFolder, 0755, true, true);
                }

            }


            $this->info("Module created successfully !");
        }
    }
}
