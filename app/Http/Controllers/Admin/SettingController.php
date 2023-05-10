<?php

namespace App\Http\Controllers\Admin;


use function App\helpers\fileUploader;
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
                'keywords' => $request['keywords'],
                'domain' => $request['domain'],
                'first_logo' => $first_logo,
                'second_logo' => $second_logo,
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
                'keywords' => $request['keywords'],
                'domain' => $request['domain'],
                'first_logo' => $first_logo,
                'second_logo' => $second_logo,
                'wysiwyg' => $request['wysiwyg'],
            ]);
        }
        return back()->with(['update' => 'success']);

    }
}
