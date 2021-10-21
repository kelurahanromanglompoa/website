<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use \App\Models\{
    Role
};


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        Paginator::useBootstrap();
        date_default_timezone_set('Asia/Makassar');

        //define gate
        Gate::define('super_admin', function($user){
            return $user->role_id == 1;
        });

        Gate::define('admin', function($user){
            return $user->role_id == 2;
        });

    }
}
