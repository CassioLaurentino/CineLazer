<?php

namespace App\Providers;

use Auth;

use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $this->registerPolicies();

        Gate::define('admin_only', function () {
            return Auth::user()->isAdmin();
        });

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            if (Auth::user()->isAdmin()) {
                $event->menu->add('FERRAMENTAS ADMINISTRATIVAS');
                $event->menu->add([
                    'text' => 'DashBoards',
                    'url'  => '/dashbord',
                    'icon' => 'bar-chart',
                    'can'  => 'admin_only',
                ]);
                $event->menu->add([
                    'text' => 'Relatórios',
                    'url'  => '/relatorios',
                    'icon' => 'file-pdf-o',
                    'can'  => 'admin_only',
                ]);
            }
        });
    }
}
