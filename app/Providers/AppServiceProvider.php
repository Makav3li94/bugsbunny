<?php

namespace App\Providers;


use App\Models\Category;
use App\Models\FrontMenu;
use App\Models\FrontSocail;
use App\Models\Section;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
//        $mostPopular = Section::withCount(['replies' => function ($query) {
//            $query->where('created_at', '>=', carbon()->now()->subDay());
//        }])->orderBy('posts_count', 'DESC')
//            ->get();
        Schema::defaultStringLength(191);
        $categories = Category::with(['sections','activeSections'])->get();
        $setting = Setting::all()->first();
        $FrontMenu = FrontMenu::get();
        $frontMenuHeader = $FrontMenu->where('type', 0);
        $frontMenusFooter1 = $FrontMenu->where('type', 1);
        $frontMenusFooter2 = $FrontMenu->where('type', 2);
        $frontMenusFooter3 = $FrontMenu->where('type', 3);
        $frontSocail = FrontSocail::all();


        view()->composer('*', function ($view) use ( $categories, $setting, $frontMenuHeader, $frontMenusFooter1, $frontMenusFooter2, $frontMenusFooter3, $frontSocail) {

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
