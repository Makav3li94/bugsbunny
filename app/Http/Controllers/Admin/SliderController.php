<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    protected function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index', compact('sliders'));
    }

    protected function create()
    {
        return view('admin.sliders.create');
    }

    protected function store(Request $request)
    {
        $request->validate([
            'image_link' => 'required',
        ]);

        Slider::create([
            'image_link' => $request['image_link'],
            'href' => $request['href'],
        ]);
        return back()->with(['store' => 'success']);
    }

    protected function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    protected function update(Request $request, Slider $slider)
    {
        $request->validate([
            'image_link' => 'required',
        ]);

        $slider->update([
            'image_link' => $request['image_link'],
            'href' => $request['href'],
        ]);
        return back()->with(['update' => 'success']);
    }

    protected function destroy(Slider $slider)
    {

        $slider->delete();
        return back()->with(['destroy' => 'success']);
    }
}
