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
            'AdminPermission',
            'ConfigAdmin',
            'ConfigBanner',
            'ConfigBrand',
            'ConfigCategory',
            'ConfigColorGroup',
            'ConfigColorPosition',
            'ConfigFormPayment',
            'ConfigFreight',
            'ConfigKeyword',
            'ConfigKit',
            'ConfigModule',
            'ConfigPage',
            'ConfigPercent',
            'ConfigPermission',
            'ConfigProduct',
            'ConfigProfile',
            'ConfigProfileClient',
            'ConfigSection',
            'ConfigShipping',
            'ConfigSite',
            'ConfigSlider',
            'ConfigStatusPayment',
            'ConfigSubjectContact',
            'ConfigSystem',
            'ConfigTemplate',
            'ConfigUnitMeasure',
            'ContentDeliveryReturn',
            'ContentFormPayment',
            'ContentPrivacyPolicy',
            'ContentTermsConditions',
            'ImageAdmin',
            'ImageBanner',
            'ImageSlider'
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
