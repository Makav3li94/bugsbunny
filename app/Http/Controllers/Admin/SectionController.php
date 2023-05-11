<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Verta;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $challenges = Section::where([['type', 1], ['user_id', 1]]);
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
            'category_id ' => 'required|numeric',
            'description' => 'required|string',
            'excerpt' => 'required|string',
            'prize_text' => 'required|string',
        ]);
        if (isset($request->expire_date)) {

            $published_at = $this->convertNumbers($request->expire_date);
            $published_at = explode('/', $published_at);
            $published_at = Verta::getGregorian($published_at[0], $published_at[1], $published_at[2]);

            $published_at = $published_at[0] . "-" . $published_at[1] . "-" . $published_at[2];
            if (isset($request->publish_time)) {
                if (strlen($request->publish_time) == 5) {
                    $published_at .= " " . $request->publish_time . ":00";
                } else {
                    $published_at .= " " . $request->publish_time;
                }
            }
            $published_at = Carbon::createFromFormat('Y-m-d H:i:s', $published_at)->toDateTimeString();
        } else {
            $published_at = Carbon::now()->toDateTimeString();
        }

        $challenge = Section::create([
           'title'=> $request->title,
           'slug'=>$request->slug,
           'category_id'=>$request->category_id,
           'type'=>1,
           'user_id'=>1,
           'description'=>$request->description,
           'excerpt'=>$request->excerpt,
           'prize_text'=>$request->prize_text,
           'expire_date'=>$published_at,
        ]);

        return view('admin.challenges.sections.edit',compact('challenge'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        //
    }
}
