<?php

namespace App\Http\Controllers\User;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\User;
use App\Traits\Helpers;
use App\Traits\Numbers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Hekmatinasser\Verta\Verta;
class SectionController extends Controller
{
    use Numbers, Helpers;


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'category_id' => 'required|numeric',
            'slug' => 'unique:sections',
            'description' => 'required|string',
        ]);
        $kind = 0;
        $status = 0;

        if (isset($request->thread)) {
            $kind = 1;
            $status = 1;
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput()->with('for','thread');
            }
        }else{
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput()->with('for','section');
            }
        }


        if (isset($request->expire_date)) {

            $published_at = $this->expireDate($request->expire_date);
        } else {
            $published_at = Carbon::now()->toDateTimeString();
        }

        $challenge = Section::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'type' => 0,
            'kind' => $kind,
            'user_id' => auth()->id(),
            'description' => $request->description,
            'excerpt' => $request->excerpt ?? Str::limit($request->description, 50),
            'expire_date' => $published_at,
            'status' => $status,
        ])->getSlugOptions('title');


        $user = User::find(auth()->id());
        $this->notifyAdmin($user->id, $user->name, $user->mobile, 'challenge', $challenge->id, 0, 'کاربر چالش یا سوال جدیدی ایجاد کرد.');
        if (isset($request->thread)) {
            LogActivity::addToLog('سوال جدیدی ایجاد کرد.','thread',$challenge->id);
        }else{
            LogActivity::addToLog('چالش جدیدی ایجاد کرد.','section',$challenge->id);
        }
        return back()->with(['store' => 'success','crud'=> $kind == 0 ?'section_store' : 'thread_store' ,'section_id'=>$challenge->id]);
    }


    public function edit($id, Request $request)
    {
        $challenge = Section::findOrFail($id);
        $challenge['expire_date'] = $this->convertToJalaliDate($challenge->expire_date, true);
        if ($request->ajax()) {
            return response()->json(['section' => $challenge]);
        }
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
        $section = Section::find($id);
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'category_id' => 'required|numeric',
                'description' => 'required|string',
                'excerpt' => 'string|min:3|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(['collapseSectionError' => $validator->errors()->toArray()]);
            }
            $title = $request->input('title');
            $category_id = $request->input('category_id');
            $description = $request->input('description');
            $excerpt = $request->input('excerpt');
            if (isset($request->expire_date)) {
                $published_at = $this->expireDate($request->expire_date);
            } else {
                $published_at = Carbon::now()->toDateTimeString();
            }

            $section->update([
                'title' => $title,
                'category_id' => $category_id,
                'description' => $description,
                'excerpt' => $excerpt,
                'expire_date' => $published_at,
                'status' => 1
            ]);
            $section = [
                0 => $section->title,
                1 => $section->id,
                2 => $section->category->title,
                3 => $this->convertNumbers($request->expire_date),
                4 => $section->kind,
            ];
            return response()->json(['collapseSectionEdit' => 'success', 'section' => $section]);
        }

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
