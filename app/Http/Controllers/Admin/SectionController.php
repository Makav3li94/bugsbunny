<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Traits\Numbers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Verta;
use Str;
class SectionController extends Controller
{
    use Numbers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $challenges = Section::where([['type', 1], ['user_id', 1]])->get();
        return view('admin.challenges.sections.index', compact('challenges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.challenges.sections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'category_id' => 'required|numeric',
            'slug' => 'unique:sections',
            'description' => 'required|string',
            'excerpt' => 'required|string',
            'prize_text' => 'required|string',
        ]);
        if (isset($request->expire_date)) {

            $published_at = $this->expireDate($request->expire_date);
        } else {
            $published_at = Carbon::now()->toDateTimeString();
        }

        $challenge = Section::create([
            'title' => $request->title,
            'slug' => !empty($request->slug) ? preg_replace('/\s+/', '-', $request->slug) : Str::slug($request->title, '-'),
            'category_id' => $request->category_id,
            'type' => 1,
            'user_id' => 1,
            'description' => $request->description,
            'excerpt' => $request->excerpt,
            'prize_text' => $request->prize_text,
            'expire_date' => $published_at,
        ]);

        return view('admin.challenges.sections.edit', compact('challenge'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $challenge = Section::findOrFail($id);
        $challenge['expire_date'] = $this->convertToJalaliDate($challenge->expire_date);
        return view('admin.challenges.sections.edit', compact('challenge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'category_id' => 'required|numeric',
            'slug' => 'required|unique:sections,slug,' . $id,
            'description' => 'required|string',
            'excerpt' => 'required|string',
            'prize_text' => 'required|string',
        ]);
        $challenge = Section::findOrFail($id);

        if (isset($request->expire_date)) {
            $published_at = $this->expireDate($request->expire_date);
        } else {
            $published_at = Carbon::now()->toDateTimeString();
        }
        if ($challenge->category_id != $request->category_id) {
            $con = true;
        }else{
            $con = false;
        }

        $challenge->update([
            'title' => $request->title,
            'slug' => !empty($request->slug) ? preg_replace('/\s+/', '-', $request->slug) : Str::slug($request->title, '-'),
            'category_id' => $request->category_id,
            'description' => $request->description,
            'excerpt' => $request->excerpt,
            'prize_text' => $request->prize_text,
            'expire_date' => $published_at,
        ]);
        if ($con){
            $challenge->questions()->update(['section_id'=>$request->category_id]);
        }
        return redirect()->back()->with('update','success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $challenge = Section::findOrFail($id);
        $challenge->delete();
        return redirect()->back()->with('delete','success');
    }

    /**
     * @param Request $request
     * @return string
     */
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