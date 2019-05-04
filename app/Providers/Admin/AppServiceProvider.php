<?php

namespace AVDPainel\Providers\Admin;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

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
            'ConfigKit',
            'ConfigSite',
            'ConfigAdmin',
            'ConfigBrand',
            'ConfigModule',
            'ConfigSystem',
            'ConfigProfile',
            'ConfigProduct',
            'ConfigFreight',
            'ConfigPercent',
            'ConfigKeyword',
            'ConfigSection',
            'ConfigCategory',
            'ConfigShipping',
            'ConfigColorGroup',
            'ConfigPermission',
            'ConfigFormPayment',
            'ConfigStatusPayment',
            'ConfigUnitMeasure',
            'ConfigImageProduct',
            'ConfigProfileClient',
            'ConfigSubjectContact',
            'AdminPermission',
            'AdminAccess',
            'Admin',
            'State',
            'Brand',
            'Section',
            'Category',
            'Product',
            'GroupColor',
            'GridBrand',
            'GridSection',
            'GridCategory',
            'GridProduct',
            'ProductPrice',
            'ImageAdmin',
            'ImageBrand',
            'ImageSection',
            'ImageCategory',
            'ImageColor',
            'ImagePosition',
            'User',
            'UserNote',
            'UserAddress',
            'Wishlist',
            'Contact',
            'ContactSpam',
            'Order',
            'OrderItem',
            'OrderNote',
            'OrderShipping'
        );

        foreach ($models as $model) {
            $this->app->bind("AVDPainel\Interfaces\Admin\\{$model}Interface", "AVDPainel\Repositories\Admin\\{$model}Repository");
        }    
    }
}
