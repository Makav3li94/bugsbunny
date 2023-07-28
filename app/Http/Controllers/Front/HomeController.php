<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Contact;
use App\Models\FrontCallTo;
use App\Models\FrontFaq;
use App\Models\FrontFeature;
use App\Models\FrontHero;
use App\Models\FrontOverlay;
use App\Models\FrontWay;
use App\Models\LogActivity;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizHeader;
use App\Models\Reply;
use App\Models\Section;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\TotalScore;
use App\Models\User;
use App\Traits\Randomable;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    use Randomable;

    public function index()
    {
        $setting = Setting::first();
        $categories = Category::all();

        $frontFaqs = FrontFaq::all();
        $frontCallTo = FrontCallTo::first();
        $frontFeatures = FrontFeature::all();
        $frontHeros = FrontHero::first();
        $frontOverlay = FrontOverlay::first();
        $frontWays = FrontWay::all();

        return view('front.home', compact('setting', 'categories', 'frontCallTo', 'frontFaqs', 'frontFeatures', 'frontHeros', 'frontOverlay', 'frontWays'));
    }

    public function user($username)
    {
        $user = User::where('username', $username)->first();

        //Open Tickets Count
        if (Setting::all()->count() > 0) {
            $setting = Setting::all()->first();
        } else {
            $setting = null;
        }
        $cats = Category::all();
        $sliders = Slider::all();
        //Sliders
        $userSections = Section::where([['type', 0], ['status', 2], ['user_id', $user->id]])->orWhere('status', 4)->get();
//        $likeDis=  Like::query()->whereMorphedTo('userable', $user)->get();
        $activities = LogActivity::where('user_id', $user->id)->get();
        $plusScores = TotalScore::where([['user_id', $user->id], ['type', 1]])->get()->sum('score');
        $minusScores = TotalScore::where([['user_id', $user->id], ['type', 0]])->get()->sum('score');
        $threads = Section::where([['kind', 1], ['user_id', $user->id]])->get();
//        $totalScore = ($likes - $dislikes) + ($plusScores - $minusScores);
        $totalScore = $plusScores - $minusScores;
        $section_count = Section::where('user_id', $user->id)->count();
        $thread_count = Section::where([['kind', 1], ['user_id', $user->id]])->count();
        $reply_count = Reply::where('user_id', $user->id)->count();
        $likes = Reply::where('user_id', $user->id)->withCount(['likes', 'dislikes'])->get()->sum('likes_count');
        return view('user.profile', compact('threads', 'sliders', 'section_count', 'thread_count', 'reply_count', 'likes', 'setting', 'cats', 'user', 'userSections', 'activities', 'totalScore'));
    }

    public function contactUs()
    {
        $array = $this->createRandomNumbers();
        return view('front.contact_us', compact('array'));
    }

    public function contactUsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'tel' => 'required|numeric',
            'message' => 'required|string|max:1000',
        ]);
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'tel' => $request->tel,
            'message' => $request->message,
        ]);
        return redirect()->back()->with('contact', 'sent');
    }

    public function chaleshKade()
    {

        $section = Section::whereIn('status', [2, 4])->with('category')->orderBy('id', 'desc')->get();
        $mainSection = $section->where('kind', 0)->where('type', 1);
        $userSection = $section->where('kind', 0)->where('type', 0);
        $threads = $section->where('kind', 1);

        list($mostViewed, $mostPopular, $latestComment, $HighAllTimeUsersScores, $HighAllTimeUsers, $HighLastWeekUsersUsers, $HighLastWeekUsersScores) = $this->stats();
        return view('front.chalesh_kade', compact('mostViewed', 'HighLastWeekUsersUsers', 'HighLastWeekUsersScores', 'HighAllTimeUsersScores', 'HighAllTimeUsers', 'latestComment', 'mostPopular', 'mainSection', 'userSection', 'threads'));
    }

    public function section($slug)
    {
        $section = Section::where('slug', $slug)->with(['questions' => function ($q) {
            $q->with('answers');
        }])->first();
        $section->increment('total_views');
        $best_user = '';
        $replies = Reply::where([['section_id', $section->id], ['parent_id', 0]])->with(['user', 'children' => function ($q) {
            $q->with('user')->withCount(['likes', 'dislikes']);
        }])->withCount(['likes', 'dislikes'])->get();
        if ($section->status == 4) {
//          return  $best_user = QuizHeader::latest()->where('section_id',$section->id)->value('score');
            $best_user = QuizHeader::where('section_id', $section->id)->orderBy('score', 'desc')->first();
        }

        return view('front.section', compact('section', 'replies', 'best_user'));
    }

    public function category($slug)
    {
        $category = Category::where('title', $slug)->first();
        $section = Section::where('category_id', $category->id)->whereIn('status', [2, 4])->with('category')->orderBy('id', 'desc')->get();
        list($mostViewed, $mostPopular, $latestComment, $HighAllTimeUsersScores, $HighAllTimeUsers, $HighLastWeekUsersUsers, $HighLastWeekUsersScores) = $this->stats();
        return view('front.category', compact('category', 'mostViewed', 'HighLastWeekUsersScores', 'HighLastWeekUsersUsers', 'HighAllTimeUsersScores', 'HighAllTimeUsers', 'latestComment', 'mostPopular', 'section'));
    }

    public function quiz(Request $request, Section $section)
    {
        $request->validate([
            'answer' => 'required|array',
            'answer.*' => 'required',
        ]);

        $quizHeader = QuizHeader::create([
            'user_id' => auth()->id(),
            'section_id' => $section->id,
            'quiz_size' => $section->questions()->count(),
            'questions_taken' => serialize($request->answer),
            'completed' => 1,
            'status' => 0,
            'score' => 0,
        ]);
        foreach ($request->answer as $key => $value) {
            $q = Question::where('id', $key)->first();
            $a = Answer::where([['question_id', $q->id], ['is_checked', '1']])->first();
            $ua = Answer::find($value);

            Quiz::create([
                'user_id' => auth()->id(),
                'section_id' => $section->id,
                'quiz_header_id' => $quizHeader->id,
                'question_id' => $key,
                'answer_id' => $value,
                'is_correct' => $a->id == $ua->id ? 1 : 0,
                'unit' => $q->unit
            ]);
        }

        return redirect()->back()->with('quiz', 'success');
    }

    public function show($slug)
    {
        $page = Blog::where('slug', $slug)->first();
        if (!$page) {
            return redirect(route($slug));
        }
        return view('front.page', compact('page'));
    }


    public function archive(Request $request)
    {
        $val = $request->input('s_val');
        $cat = $request->input('category');
        if ($cat == 'all') {
            $sections = Section::with('category')->where('title', 'like', "%$val%")->whereIn('status', [2, 4])->paginate(5);
        } else {
            $sections = Section::with('category')->where([['category_id', $cat ?? true], ['title', 'like', "%$val%"]])->whereIn('status', [2, 4])->paginate(5);
        }
        list($mostViewed, $mostPopular, $latestComment, $HighAllTimeUsersScores, $HighAllTimeUsers, $HighLastWeekUsersUsers, $HighLastWeekUsersScores) = $this->stats();
        return view('front.archive', compact('val', 'sections', 'mostViewed', 'HighLastWeekUsersScores', 'HighLastWeekUsersUsers', 'HighAllTimeUsersScores', 'HighAllTimeUsers', 'latestComment', 'mostPopular'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $val = $request->input('val');
            $cat = $request->input('cat');
            if ($cat == 'all') {
                $sectionByTitle = Section::where([['status', '=', 2], ['title', 'like', "%$val%"]])->get();
            } else {
                $sectionByTitle = Section::where([['status', '=', 2], ['category_id', $cat ?? true], ['title', 'like', "%$val%"]])->get();
            }
            if (count($sectionByTitle) == 0) {
                return response()->json([
                    'records' => 'none'
                ]);
            } else {
                $result = [];

                foreach ($sectionByTitle as $key => $section) {
                    $result[$key] = [
                        'name' => $section->title,
                        'link' => route('section', $section->slug),
                    ];
                }
                return response()->json([
                    'records' => $result
                ]);
            }
        }
    }

    /**
     * @return array
     */
    protected function stats(): array
    {
        $section = Section::with(['replies', 'category', 'latestReply'])->withCount('replies')->has('replies')->whereIn('status', [2, 4])->get();
        $mostViewed = $section->take(5)->sortByDesc("total_views");
        $mostPopular = $section->take(5)->sortByDesc("replies_count");
        $latestComment = $section->take(5)->sortByDesc("latestReply.created_at");
//        $mostViewed = Section::where('status', 2)->orWhere('status', 4)->orderBy('total_views', 'desc')->take(5)->get();
//        $mostPopular = Section::where('status', 2)->orWhere('status', 4)->withCount('replies')->orderBy('replies_count', 'desc')->take(5)->get();
//        $latestComment = Section::with('replies')->has('replies')->get()->sortByDesc('latestReply.created_at');
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
        if (count($ids) > 0) {

            $HighAllTimeUsers = User::whereIn('id', $ids)
                ->orderByRaw("field(id," . implode(',', $ids) . ")")
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
        return array($mostViewed, $mostPopular, $latestComment, $HighAllTimeUsersScores, $HighAllTimeUsers, $HighLastWeekUsersUsers, $HighLastWeekUsersScores);
    }

}
