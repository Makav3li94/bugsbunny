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
        $categories = Category::all();
        $setting = Setting::all()->first();
        $frontMenuHeader = FrontMenu::where('type', 0)->get();
        $frontMenusFooter1 = FrontMenu::where('type', 1)->get();
        $frontMenusFooter2 = FrontMenu::where('type', 2)->get();
        $frontMenusFooter3 = FrontMenu::where('type', 3)->get();
        $frontSocail = FrontSocail::all();
        $mostViewed = Section::where('status',2)->orWhere('status',4)->orderBy('total_views', 'desc')->take(5)->get();
        $mostPopular = Section::where('status',2)->orWhere('status',4)->withCount('replies')->orderBy('replies_count', 'desc')->take(5)->get();
        $latestComment = Section::with('replies')->has('replies')->get()->sortByDesc('latestReply.created_at');
        $HighAllTimeUsersScores = (DB::select(DB::raw("SELECT y.*
                  FROM (SELECT
                        t.id,
                        t.user_id,
                        (SELECT SUM(x.score)
                         FROM total_scores  x
                         WHERE   x.user_id = t.user_id and x.type = 1)
                        -
                        COALESCE((SELECT SUM(x.score)
                                  FROM total_scores  x
                                  WHERE  x.user_id = t.user_id and x.type = 0),0)
                        AS total
                        FROM total_scores  t
                     ORDER BY t.id) y
                GROUP BY y.user_id
                ORDER BY total DESC limit 5")));
        $ids = Arr::pluck($HighAllTimeUsersScores, 'user_id');
        $HighAllTimeUsers = [];
        if (count($ids) > 0){

            $HighAllTimeUsers = User::whereIn('id', $ids)
            ->orderByRaw("field(id,".implode(',',$ids).")")
            ->get()->toArray();
        }

        $HighLastWeekUsersScores = (DB::select(DB::raw("SELECT y.*
                  FROM (SELECT
                        t.id,
                        t.user_id,
                        (SELECT SUM(x.score)
                         FROM total_scores  x
                         WHERE   x.user_id = t.user_id and x.type = 1
                            AND x.created_at between date_sub(now(),INTERVAL 1 WEEK) and now()
                            )
                        -
                        COALESCE((SELECT SUM(x.score)
                                  FROM total_scores  x
                                  WHERE  x.user_id = t.user_id and x.type = 0
                                   AND x.created_at between date_sub(now(),INTERVAL 1 WEEK) and now()
                                  ),0)
                        AS total
                        FROM total_scores  t
                     ORDER BY t.id) y
                GROUP BY y.user_id
                ORDER BY total DESC limit 5")));
        $aids = Arr::pluck($HighLastWeekUsersScores, 'user_id');
        $HighLastWeekUsersUsers = [];
        if (count($aids) > 0) {
            $HighLastWeekUsersUsers = User::whereIn('id', $aids)
                ->orderByRaw("field(id," . implode(',', $aids) . ")")
                ->get()->toArray();
        }

        view()->composer('*', function ($view) use ($HighLastWeekUsersScores,$HighLastWeekUsersUsers,$HighAllTimeUsersScores,$HighAllTimeUsers, $latestComment, $mostPopular, $categories, $setting, $frontMenuHeader, $frontMenusFooter1, $frontMenusFooter2, $frontMenusFooter3, $frontSocail, $mostViewed) {

            $view->with(
                [
                    'categories' => $categories,
                    'setting' => $setting,
                    'frontMenuHeader' => $frontMenuHeader,
                    'frontMenusFooter1' => $frontMenusFooter1,
                    'frontMenusFooter2' => $frontMenusFooter2,
                    'frontMenusFooter3' => $frontMenusFooter3,
                    'frontSocail' => $frontSocail,
                    'mostViewed' => $mostViewed,
                    'mostPopular' => $mostPopular,
                    'latestComment' => $latestComment,
                    'HighAllTimeUsers' => $HighAllTimeUsers,
                    'HighAllTimeUsersScores' => $HighAllTimeUsersScores,
                    'HighLastWeekUsersScores' => $HighLastWeekUsersScores,
                    'HighLastWeekUsersUsers' => $HighLastWeekUsersUsers,
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
