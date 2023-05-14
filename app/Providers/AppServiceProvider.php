<?php

namespace App\Providers;


use App\Models\Category;
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

        Schema::defaultStringLength(191);
        $categories = Category::all();
        $setting = Setting::all()->first();
        view()->composer('*', function ($view) use ($categories,$setting) {

            $view->with(
                [
                    'categories' => $categories,
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
