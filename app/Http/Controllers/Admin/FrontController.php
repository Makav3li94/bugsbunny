<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontCallTo;
use App\Models\FrontFaq;
use App\Models\FrontFeature;
use App\Models\FrontHero;
use App\Models\FrontMenu;
use App\Models\FrontOverlay;
use App\Models\FrontSocail;
use App\Models\FrontWay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FrontController extends Controller
{
    public function editMenu()
    {
        return view('admin.front.menu');
    }

    public function editMenuInfo(Request $request, FrontMenu $frontMenu)
    {
        if ($request->ajax()) {
            return response()->json(['menu' => $frontMenu]);
        }
    }

    public function storeMenu(Request $request)
    {
        FrontMenu::create([
            'title' => $request->title,
            'link' => $request->link,
            'type' => $request->type
        ]);
        return back()->with(['store' => 'success']);
    }

    public function updateMenu(Request $request, FrontMenu $frontMenu)
    {
        $frontMenu->update([
            'title' => $request->title,
            'link' => $request->link,
            'type' => $request->type
        ]);
        return back()->with(['update' => 'success']);
    }

    public function deleteMenu(FrontMenu $frontMenu)
    {
        $frontMenu->delete();
        return back()->with(['delete' => 'success']);
    }

//    Hero

    public function editHero()
    {
        $hero = FrontHero::first();
        return view('admin.front.hero', compact('hero'));
    }

    public function updateHero(Request $request, FrontHero $frontHero)
    {
        $frontHero->update([
            'title' => $request->title,
            'sub' => $request->sub,
            'search_placeholder' => $request->search_placeholder,
        ]);
        return back()->with(['update' => 'success']);
    }

//Features

    public function editFeature()
    {
        $features = FrontFeature::all();
        return view('admin.front.feature', compact('features'));
    }

    public function editFeatureInfo(Request $request, FrontFeature $frontFeature)
    {
        if ($request->ajax()) {
            $frontFeature['icon'] = asset('images/front/feature/' . $frontFeature->icon);
            return response()->json(['feature' => $frontFeature]);
        }
    }

    public function storeFeature(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'sub' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:512',
        ]);
        if (request()->hasFile('icon')) {
            $icon = time() . '.' . request()->icon->getClientOriginalExtension();
            request()->icon->move(public_path('images/front/feature/'), $icon);
        } else
            $icon = null;
        FrontFeature::create([
            'title' => $request->title,
            'sub' => $request->sub,
            'icon' => $icon
        ]);
        return back()->with(['store' => 'success']);
    }

    public function updateFeature(Request $request, FrontFeature $frontFeature)
    {
        $this->validate($request, [
            'title' => 'required',
            'sub' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:512',
        ]);

        if ($request->hasFile('icon')) {
            if ($frontFeature->icon != null) {
                $featureImage = public_path("images/front/feature/{$frontFeature->icon}"); // get previous image from folder
                if (File::exists($featureImage)) { // unlink or remove previous image from folder
                    unlink($featureImage);
                }
            }
            $icon = time() . '.' . request()->icon->getClientOriginalExtension();
            request()->icon->move(public_path('images/front/feature/'), $icon);
        } else
            $icon = null;

        $frontFeature->update([
            'title' => $request->title,
            'sub' => $request->sub,
            'icon' => $icon != null ? $icon : $frontFeature->icon,
        ]);
        return back()->with(['update' => 'success']);
    }

    public function deleteFeature(FrontFeature $frontFeature)
    {
        $frontFeature->delete();
        return back()->with(['delete' => 'success']);
    }


    //Ways

    public function editWay()
    {
        $ways = FrontWay::all();
        return view('admin.front.way', compact('ways'));
    }

    public function editWayInfo(Request $request, FrontWay $frontWay)
    {
        if ($request->ajax()) {
            $frontWay['icon'] = asset('images/front/way/' . $frontWay->icon);
            return response()->json(['way' => $frontWay]);
        }
    }

    public function storeWay(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'sub' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:512',
        ]);
        if (request()->hasFile('icon')) {
            $icon = time() . '.' . request()->icon->getClientOriginalExtension();
            request()->icon->move(public_path('images/front/way/'), $icon);
        } else
            $icon = null;
        FrontWay::create([
            'title' => $request->title,
            'sub' => $request->sub,
            'icon' => $icon,
            'type'=>0
        ]);
        return back()->with(['store' => 'success']);
    }

    public function updateWay(Request $request, FrontWay $frontWay)
    {
        if (isset($request->main)) {
            $frontWay->update([
                'title' => $request->title,
                'sub' => $request->sub,
            ]);
            return back()->with(['update' => 'success']);
        } else {
            $this->validate($request, [
                'title' => 'required',
                'sub' => 'required',
                'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:512',
            ]);

            if ($request->hasFile('icon')) {
                if ($frontWay->icon != null) {
                    $wayImage = public_path("images/front/way/{$frontWay->icon}"); // get previous image from folder
                    if (File::exists($wayImage)) { // unlink or remove previous image from folder
                        unlink($wayImage);
                    }
                }
                $icon = time() . '.' . request()->icon->getClientOriginalExtension();
                request()->icon->move(public_path('images/front/way/'), $icon);
            } else
                $icon = null;

            $frontWay->update([
                'title' => $request->title,
                'sub' => $request->sub,
                'icon' => $icon != null ? $icon : $frontWay->icon,
            ]);
            return back()->with(['update' => 'success']);
        }
    }

    public function deleteWay(FrontWay $frontWay)
    {
        $frontWay->delete();
        return back()->with(['delete' => 'success']);
    }


    //    Hero

    public function editOverlay()
    {
        $overlay = FrontOverlay::first();
        return view('admin.front.overlay', compact('overlay'));
    }

    public function updateOverlay(Request $request, FrontOverlay $frontOverlay)
    {
        if ($request->hasFile('bg')) {
            if ($frontOverlay->bg != null) {
                $overlayImage = public_path("images/front/overlay/{$frontOverlay->bg}"); // get previous image from folder
                if (File::exists($overlayImage)) { // unlink or remove previous image from folder
                    unlink($overlayImage);
                }
            }
            $bg = time() . '.' . request()->bg->getClientOriginalExtension();
            request()->bg->move(public_path('images/front/overlay/'), $bg);
        } else
            $bg = null;

        $frontOverlay->update([
            'body' => $request->body,
            'bg' => $bg != null ? $bg : $frontOverlay->bg,
        ]);
        return back()->with(['update' => 'success']);
    }

    //    call too

    public function editCall()
    {
        $call = FrontCallTo::first();
        return view('admin.front.call', compact('call'));
    }

    public function updateCall(Request $request, $id)
    {
        $frontCallTo = FrontCallTo::find($id);
        if ($request->hasFile('bg')) {
            if ($frontCallTo->bg != null) {
                $callImage = public_path("images/front/call/{$frontCallTo->bg}"); // get previous image from folder
                if (File::exists($callImage)) { // unlink or remove previous image from folder
                    unlink($callImage);
                }
            }
            $bg = time() . '.' . request()->bg->getClientOriginalExtension();
            request()->bg->move(public_path('images/front/call/'), $bg);
        } else
            $bg = null;

        $frontCallTo->update([
            'title' => $request->title,
            'sub' => $request->sub,
            'link_title' => $request->link_title,
            'link' => $request->link,
            'bg' =>  $bg != null ? $bg : $frontCallTo->bg,
        ]);
        return back()->with(['update' => 'success']);
    }


    //Socails

    public function editSocial()
    {
        $socials = FrontSocail::all();
        return view('admin.front.social', compact('socials'));
    }

    public function editSocialInfo(Request $request, FrontSocail $frontSocail)
    {
        if ($request->ajax()) {
            $frontSocail['icon'] = asset('images/front/socail/' . $frontSocail->icon);
            return response()->json(['social' => $frontSocail]);
        }
    }

    public function storeSocial(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:512',
        ]);
        if (request()->hasFile('icon')) {
            $icon = time() . '.' . request()->icon->getClientOriginalExtension();
            request()->icon->move(public_path('images/front/socail/'), $icon);
        } else
            $icon = null;
        FrontSocail::create([
            'title' => $request->title,
            'link' => $request->link,
            'icon' => $icon,
        ]);

        return back()->with(['store' => 'success']);
    }

    public function updateSocial(Request $request, FrontSocail $frontSocail)
    {

            $this->validate($request, [
                'title' => 'required',
                'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:512',
            ]);

            if ($request->hasFile('icon')) {
                if ($frontSocail->icon != null) {
                    $socialImage = public_path("images/front/socail/{$frontSocail->icon}"); // get previous image from folder
                    if (File::exists($socialImage)) { // unlink or remove previous image from folder
                        unlink($socialImage);
                    }
                }
                $icon = time() . '.' . request()->icon->getClientOriginalExtension();
                request()->icon->move(public_path('images/front/socail/'), $icon);
            } else
                $icon = null;

        $frontSocail->update([
                'title' => $request->title,
                'link' => $request->link,
                'icon' => $icon != null ? $icon : $frontSocail->icon,
            ]);
            return back()->with(['update' => 'success']);

    }

    public function deleteSocial(FrontSocail $frontSocail)
    {
        $frontSocail->delete();
        return back()->with(['delete' => 'success']);
    }



    //Faq

    public function editFaq()
    {
        $faqs = FrontFaq::all();
        return view('admin.front.faq', compact('faqs'));
    }

    public function editFaqInfo(Request $request, FrontFaq $frontFaq)
    {
        if ($request->ajax()) {
            return response()->json(['faq' => $frontFaq]);
        }
    }

    public function storeFaq(Request $request)
    {
        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required',
        ]);

        FrontFaq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'type'=>1
        ]);
        return back()->with(['store' => 'success']);
    }

    public function updateFaq(Request $request, FrontFaq $frontFaq)
    {
        if (isset($request->main)) {
            $frontFaq->update([
                'title' => $request->title,
                'sub' => $request->sub,
            ]);
            return back()->with(['update' => 'success']);
        } else {
            $this->validate($request, [
                'question' => 'required',
                'answer' => 'required',
            ]);

            $frontFaq->update([
                'question' => $request->question,
                'answer' => $request->answer,
            ]);
            return back()->with(['update' => 'success']);
        }
    }

    public function deleteFaq(FrontFaq $frontFaq)
    {
        $frontFaq->delete();
        return back()->with(['delete' => 'success']);
    }

}
