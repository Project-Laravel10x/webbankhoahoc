<?php

namespace App\Providers;

use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Groups\src\Models\Module;
use Modules\Students\src\Models\Student;
use Modules\User\src\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        ResetPassword::createUrlUsing(function (Student $student, string $token) {
            return route('students.reset_password', $token) . '?email=' . $student->email;
        });

        $this->checkModuleAccess();

    }

    private function checkModuleAccess()
    {
        $modulesList = Module::all();
        if ($modulesList->count() > 0) {
            foreach ($modulesList as $module) {

                Gate::define($module->name, function (User $user) use ($module) {
                    {
                        $roleJson = $user->groups->permissions;

                        if (!empty($roleJson)) {
                            $roleArr = json_decode($roleJson, true);
                        } else {
                            $roleArr = [];
                        }

                        return isRole($roleArr, $module->name);
                    }
                });

                Gate::define($module->name . '.add', function (User $user) use ($module) {
                    {
                        $roleJson = $user->groups->permissions;

                        if (!empty($roleJson)) {
                            $roleArr = json_decode($roleJson, true);
                        } else {
                            $roleArr = [];
                        }

                        return isRole($roleArr, $module->name, 'add');
                    }
                });
                Gate::define($module->name . '.edit', function (User $user) use ($module) {
                    {
                        $roleJson = $user->groups->permissions;

                        if (!empty($roleJson)) {
                            $roleArr = json_decode($roleJson, true);
                        } else {
                            $roleArr = [];
                        }

                        return isRole($roleArr, $module->name, 'edit');
                    }
                });
                Gate::define($module->name . '.delete', function (User $user) use ($module) {
                    {
                        $roleJson = $user->groups->permissions;

                        if (!empty($roleJson)) {
                            $roleArr = json_decode($roleJson, true);
                        } else {
                            $roleArr = [];
                        }

                        return isRole($roleArr, $module->name, 'delete');
                    }
                });

                Gate::define('groups.permission', function (User $user) {
                    {
                        $roleJson = $user->groups->permissions;
                        if (!empty($roleJson)) {
                            $roleArr = json_decode($roleJson, true);
                        } else {
                            $roleArr = [];
                        }

                        return isRole($roleArr, 'groups', 'permission');
                    }
                });
            }
        }
    }
}
