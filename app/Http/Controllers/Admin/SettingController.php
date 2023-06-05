<?php

namespace App\Http\Controllers\Admin;


use function App\Helpers\fileUploader;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;


class SettingController extends Controller
{
    public function __construct()
    {
//        $this->middleware('permission:setting')->except('dashboard');
    }

    protected function edit()
    {
        $settings = Setting::all();
        if (count($settings) > 0) {
            $settings = Setting::all()->first();
            return view('admin.settings.edit', compact('settings'));
        } else {
            $settings = null;
            return view('admin.settings.edit', compact('settings'));
        }
    }

    protected function updateOrCreate(Request $request)
    {
        $settings = Setting::all();
        $request->validate([
            'first_logo' => 'nullable|file|mimes:png,jpg,jpeg',
            'second_logo' => 'nullable|file|mimes:png,jpg,jpeg',
        ]);
        if (count($settings) > 0) {
            if ($request->file('first_logo')) {
                $first_logo = fileUploader($request->file('first_logo'), '/uploads/settings/images/logos/');
            } else {
                $first_logo = $settings->first()->first_logo;
            }
            if ($request->file('second_logo')) {
                $second_logo = fileUploader($request->file('second_logo'), '/uploads/settings/images/logos/');
            } else {
                $second_logo = $settings->first()->second_logo;
            }


            $settings->first()->update([
                'brand' => $request['brand'],
                'name' => $request['name'],
                'description' => $request['description'],
                'chalesh_name' => $request['chalesh_name'],
                'chalesh_description' => $request['chalesh_description'],
                'keywords' => $request['keywords'],
                'domain' => $request['domain'],
                'first_logo' => $first_logo,
                'second_logo' => $second_logo,
                'comment_score' => $request['comment_score'],
                'reply_score' => $request['reply_score'],
                'question_score' => $request['question_score'],
                'section_score' => $request['section_score'],
                'skip_section_score' => $request['skip_section_score'],
                'admin_section_score' => $request['admin_section_score'],
                'user_section_score' => $request['user_section_score'],
                'reg_type' => $request['reg_type'],
                'wysiwyg' => $request['wysiwyg'],
            ]);






        } else {
            if ($request->file('first_logo')) {
                $first_logo = fileUploader($request->file('first_logo'), '/uploads/settings/images/logos/');
            } else {
                $first_logo = null;
            }
            if ($request->file('second_logo')) {
                $second_logo = fileUploader($request->file('second_logo'), '/uploads/settings/images/logos/');
            } else {
                $second_logo = null;
            }
            Setting::create([
                'brand' => $request['brand'],
                'name' => $request['name'],
                'description' => $request['description'],
                'chalesh_name' => $request['chalesh_name'],
                'chalesh_description' => $request['chalesh_description'],
                'keywords' => $request['keywords'],
                'domain' => $request['domain'],
                'first_logo' => $first_logo,
                'second_logo' => $second_logo,
                'comment_score' => $request['comment_score'],
                'reply_score' => $request['reply_score'],
                'question_score' => $request['question_score'],
                'section_score' => $request['section_score'],
                'skip_section_score' => $request['skip_section_score'],
                'admin_section_score' => $request['admin_section_score'],
                'user_section_score' => $request['user_section_score'],
                'reg_type' => $request['reg_type'],
                'wysiwyg' => $request['wysiwyg'],
            ]);

        }
        return back()->with(['update' => 'success']);

    }


    public function editFront(){

    }
    public function updateFront(){

    }
}
