<?php

namespace AVDPainel\Providers\Admin;

use AVDPainel\Models\Admin\Admin;
use AVDPainel\Models\Admin\AdminPermissions;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //Admin::class => AdminPolicy::class,
    ];


    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $permissions = AdminPermissions::all();

        foreach ( $permissions as $permission ) {

            Gate::define($permission->name, function(Admin $admin) use ($permission){
                return $admin->id == $permission->admin_id;
            });
        }

        Gate::before(function(Admin $admin, $ability){
            if( $admin->profile == 'Master')
                return true;
        });

    }
}
