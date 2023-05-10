<?php

namespace App\Providers;


use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
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

//        eval(base64_decode('aWYoaXNzZXQoJF9TRVJWRVJbJ0hUVFBfSE9TVCddKSAmJiAhZW1wdHkoJF9TRVJWRVJbJ0hUVFBfSE9TVCddKSl7aWYoIUhhc2g6OmNoZWNrKCRfU0VSVkVSWydTRVJWRVJfTkFNRSddLHN1YnN0cihcQXBwXE1vZGVsc1xTZXR0aW5nOjphbGwoKS0+Zmlyc3QoKS0+X2tleSwwLDYwKSkpe2RkKCk7fX0='));
        Schema::defaultStringLength(191);
        view()->composer('layouts.main-dashboard', function ($view) {
            $setting = Setting::all()->first();
            $view->with(
                [
                    'setting' => $setting
                ]
            );
        });
        view()->composer('layouts.main', function ($view) {
            if (Setting::all()->count() > 0) {
                $setting = Setting::all()->first();
            } else {
                $setting = null;
            }
            $view->with(
                [
                    'setting' => $setting
                ]
            );
        });
        Paginator::useBootstrap();

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
