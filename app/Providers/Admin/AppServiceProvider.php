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
            'Brand',
            'Catalog',
            'Category',
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
            'Contact',
            'ContactSpam',
            'ConfigUnitMeasure',
            'ContentDeliveryReturn',
            'ContentFormPayment',
            'ContentPrivacyPolicy',
            'ContentTermsConditions',
            'GridBrand',
            'GridCategory',
            'GridProduct',
            'GridSection',
            'GroupColor',
            'ImageAdmin',
            'ImageCategory',
            'ImageColor',
            'ImageBanner',
            'ImageBrand',
            'ImagePosition',
            'ImageSection',
            'ImageSlider',
            'Inventory',
            'Order',
            'OrderItem',
            'OrderNote',
            'OrderShipping',
            'Product',
            'ProductCost',
            'ProductPrice',
            'Section',
            'State',
            'User',
            'UserAddress',
            'UserNote',
            'Wishlist'
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
