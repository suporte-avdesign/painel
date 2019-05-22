<?php

namespace AVDPainel\Providers\Admin;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('APP_ENV') === 'production') {
            $this->app['request']->server->set('HTTPS', true);
        }

        $models = array(
            'Admin',
            'AdminAccess',
            'ConfigAdmin',
            'ConfigBanner',
            'ConfigColorGroup',
            'ConfigFreight',
            'ConfigKeyword',
            'ConfigKit',
            'ConfigModule',
            'ConfigPage',
            'ConfigPermission',
            'ConfigProduct',
            'ConfigProfile',
            'ConfigProfileClient',
            'ConfigSite',
            'ConfigSlider',
            'ConfigSubjectContact',
            'ConfigSystem',
            'ConfigTemplate'
        );

        foreach ($models as $model) {
            $this->app->bind("AVDPainel\Interfaces\Admin\\{$model}Interface", "AVDPainel\Repositories\Admin\\{$model}Repository");
        }


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
