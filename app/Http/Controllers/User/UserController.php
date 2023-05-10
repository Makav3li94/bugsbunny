<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Ticket;
use Carbon\Carbon;

class UserController extends Controller
{

    protected function dashboard()
    {
        //Open Tickets Count
        $tickets=number_format(Ticket::where([['user_id',auth()->user()->id],['status','1']])->get()->count());
        if(Setting::all()->count()>0){
            $setting=Setting::all()->first();
        }
        else{
            $setting=null;
        }

        //Sliders
        $sliders=Slider::all();
        return view('user.dashboard',compact('tickets','setting','sliders'));
    }

}
