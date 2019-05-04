<?php

namespace AVDPainel\Providers\Admin;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'AVDPainel\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapAuthAdmins();
        $this->mapPanel();
        $this->mapConfigSistem();
        $this->mapUsersAdmins();
        $this->mapModules();

        //
    }

    /**
     * Define the "web" routes auth admin.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAuthAdmins()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/admin/auth.php'));
    }

    /**
     * Define the "web" routes panel admin.
     *
     * @return void
     */
    protected function mapPanel()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/admin/panel.php'));
    }

    /**
     * Define the "web" routes panel admin.
     *
     * @return void
     */
    protected function mapConfigSistem()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/admin/config.php'));
    }

    /**
     * Define the "web" routes users admin.
     *
     * @return void
     */
    protected function mapUsersAdmins()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/admin/admins.php'));
    }

    /**
     * Define the "web" routes users admin.
     *
     * @return void
     */
    protected function mapModules()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/admin/modules.php'));
    }

}
