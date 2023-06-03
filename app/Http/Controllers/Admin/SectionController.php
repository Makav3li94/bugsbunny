<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Section;
use App\Models\Setting;
use App\Models\TotalScore;
use App\Models\User;
use App\Traits\Helpers;
use App\Traits\Numbers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Verta;
use Illuminate\Support\Str;

class SectionController extends Controller
{
    use Numbers,Helpers;


    public function index()
    {
        $challenges = Section::with(['user', 'category'])->get();
        return view('admin.challenges.sections.index', compact('challenges'));
    }


    public function create()
    {
        $type = 'challenge';
        if (isset(request()->type) && request()->type == 'thread') {
            $type = 'thread';
        }
        return view('admin.challenges.sections.create', compact('type'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string',
            'category_id' => 'required|numeric',
            'slug' => 'unique:sections',
            'excerpt' => 'string|min:3|max:255',
            'prize_text' => 'string',
        ]);
        $kind = 0;
        $type = 'challenge';
        if (isset($request->kind)) {
            $kind = 1;
            $type = 'thread';
        }
        if (isset($request->expire_date)) {

            $published_at = $this->expireDate($request->expire_date);
        } else {
            $published_at = Carbon::now()->toDateTimeString();
        }

        $challenge = Section::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'type' => 1,
            'user_id' => 1,
            'kind' => $kind,
            'description' => $request->description,
            'excerpt' => $request->excerpt ?? Str::limit($request->description->value, 50),
            'prize_text' => $request->prize_text ?? "",
            'expire_date' => $published_at,
        ])->getSlugOptions('title');
        $challenges = Section::with(['user', 'category'])->get();
        return view('admin.challenges.sections.index', compact('challenges'));
    }


    public function edit($id)
    {
        $challenge = Section::findOrFail($id);
        $type = 'challenge';
        if ($challenge->category->type == 1) {
            $type = 'thread';
        }
        $challenge['expire_date'] = $this->convertToJalaliDate($challenge->expire_date, true);
        return view('admin.challenges.sections.edit', compact('challenge', 'type'));
    }

    public function show($id)
    {

        $challenge = Section::findOrFail($id)->with(['quizHeaders' => function ($q) {
            $q->with('user');
        }])->first()->toArray();
        return view('admin.challenges.sections.participants', compact('challenge'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'category_id' => 'required|numeric',
            'slug' => 'required|unique:sections,slug,' . $id,
            'description' => 'required|string',
            'excerpt' => 'string|min:3|max:255',
        ]);
        $challenge = Section::findOrFail($id);

        if (isset($request->expire_date)) {
            $published_at = $this->expireDate($request->expire_date);
        } else {
            $published_at = Carbon::now()->toDateTimeString();
        }
        if (isset($request->status)) $status = 2; else $status = 3;

        if ($challenge->type == 0) {
            $user = User::find($challenge->user_id);
            if ($challenge->kind == 0) {
                if ($status == 1) {
                    $details = ['type' => 'وضعیت چالش', 'status' => 'در حال بررسی'];
                } elseif ($status == 2) {
                    $details = ['type' => 'وضعیت چالش', 'status' => 'تایید شده'];
                    $setting = Setting::all()->first();
                    TotalScore::create([
                        'user_id' => $user->id,
                        'score' => $setting->section_score,
                        'type' => 1,
                        'is_for' => 'challenge'
                    ]);
                } elseif ($status == 3) {
                    $details = ['type' => 'وضعیت چالش', 'status' => 'رد شده'];
                }
            }elseif ($challenge->kind == 1) {
                if ($status == 1) {
                    $details = ['type' => 'وضعیت سوال', 'status' => 'در حال بررسی'];
                } elseif ($status == 2) {
                    $details = ['type' => 'وضعیت سوال', 'status' => 'تایید شده'];
                    $setting = Setting::all()->first();
                    TotalScore::create([
                        'user_id' => $user->id,
                        'score' => $setting->question_score,
                        'type' => 1,
                        'is_for' => 'thread'
                    ]);
                } elseif ($status == 3) {
                    $details = ['type' => 'وضعیت سوال', 'status' => 'رد شده'];
                }
            }

            $user->sendUserVerifyNotification($user, $details);
        }

        $challenge->update([
            'title' => $request->title,
            'slug' => !empty($request->slug) ? preg_replace('/\s+/', '-', $request->slug) : Str::slug($request->title, '-'),
            'category_id' => $request->category_id,
            'description' => $request->description,
            'excerpt' => $request->excerpt ?? Str::limit($request->description->value, 50),
            'prize_text' => $request->prize_text,
            'expire_date' => $published_at,
            'status' => $status,
        ]);
        $this->readMFNotification($challenge->user_id,'challenge',$challenge->id);
        return redirect()->back()->with('update', 'success');
    }


    public function destroy($id)
    {
        $challenge = Section::findOrFail($id);
        $challenge->delete();
        return redirect()->back()->with('delete', 'success');
    }

    protected function expireDate($expire_date): string
    {
        $published_at = $this->convertNumbers($expire_date);
        $published_at = explode('/', $published_at);
        $published_at = Verta::getGregorian($published_at[0], $published_at[1], $published_at[2]);

        $published_at = $published_at[0] . "-" . $published_at[1] . "-" . $published_at[2];
//            if (isset($request->publish_time)) {
//                if (strlen($request->publish_time) == 5) {
//                    $published_at .= " " . $request->publish_time . ":00";
//                } else {
//                    $published_at .= " " . $request->publish_time;
//                }
//            }
        $published_at = Carbon::createFromFormat('Y-m-d', $published_at)->toDateTimeString();
        return $published_at;
    }
}
