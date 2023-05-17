<?php

namespace App\Providers;


use App\Models\Category;
use App\Models\FrontMenu;
use App\Models\FrontSocail;
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
        $frontMenuHeader = FrontMenu::where('type',0)->get();
        $frontMenusFooter1 = FrontMenu::where('type',1)->get();
        $frontMenusFooter2 = FrontMenu::where('type',2)->get();
        $frontMenusFooter3 = FrontMenu::where('type',3)->get();
        $frontSocail = FrontSocail::all();

        view()->composer('*', function ($view) use ($categories,$setting,$frontMenuHeader,$frontMenusFooter1,$frontMenusFooter2,$frontMenusFooter3,$frontSocail) {

            $view->with(
                [
                    'categories' => $categories,
                    'setting' => $setting,
                    'frontMenuHeader' => $frontMenuHeader,
                    'frontMenusFooter1' => $frontMenusFooter1,
                    'frontMenusFooter2' => $frontMenusFooter2,
                    'frontMenusFooter3' => $frontMenusFooter3,
                    'frontSocail' => $frontSocail,
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
