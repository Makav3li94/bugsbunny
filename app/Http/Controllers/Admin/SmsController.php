<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendBatchSmsMokhaberat;
use App\Models\Sms;
use App\Models\SmsDelivery;
use App\Models\SmsDraft;
use App\Models\SmsSender;
use App\Models\SmsSetting;
use App\Traits\SmsableMokhaberat;
use App\Models\User;
use Illuminate\Http\Request;


class SmsController extends Controller
{
    use SmsableMokhaberat;


    public function __construct()
    {
//        $this->middleware('permission:sms')->except('dashboard');
    }

    protected function index()
    {
        $messages = Sms::orderBy('id', 'desc')->get();
        return view('admin.sms.index', compact('messages'));
//        $apis = config('constants.constants.sms');
//        foreach ($apis as $key => $api) {
//            switch ($key) {
//                case 'mokhaberat':
//                    break;
//            }
//        }
    }


    protected function create()
    {
        $drafts = SmsDraft::all();
        $sms_numbers = SmsSender::all();
        $users = User::where([['authStatus', '1'], ['is_primary', '1']])->get();
        return view('admin.sms.create', compact('sms_numbers', 'users', 'drafts'));
    }

    protected function storeBatch(Request $request)
    {

//        $smsSendersCount = SmsSender::all()->count();
        $request->validate([
            'smsSender' => "required|numeric|integer",
            'relation' => "required",
            'description' => 'required'
        ]);
        $sms_sender = SmsSender::find($request['smsSender']);
        $message = $request['description'];
        switch ($sms_sender->type) {
            case 'mokhaberat':
                foreach ($request['relation'] as $id) {
                    $sms = Sms::create([
//                    'sms_sender_id' => $sms_sender->id,
                        'sms_sender_id' => 1,
                        'user_id' => $id,
                        'description' => $message
                    ]);

                    $user = User::find($id);

//                  $job = new SendBatchSmsMokhaberat;
//                  SendBatchSmsMokhaberat::dispatchNow(User::find($id)->mobile,$sms_sender->number,$message,=);
                    SendBatchSmsMokhaberat::dispatch($user->mobile, $sms_sender->number, ["name" => $user->name, 'body' => $message], $sms->id)->delay(now()->addSeconds(40));

                }
                break;
        }
        $cmd = "php " . base_path() . "/artisan queue:work > /dev/null &";
        exec($cmd, $output);
        return back()->with(['message' => 'sent'])->withInput();

    }

    protected function storeSingle(Request $request)
    {
//        $smsSendersCount = SmsSender::all()->count();
        $request->validate([
            'smsSender' => "required|numeric|integer",
            'mobile' => "required|regex:/09[0-9]{9}/",
            'name' => 'required',
            'message' => 'required'
        ]);
        $sms_sender = SmsSender::find($request['smsSender']);
        $mobile = $request['mobile'];
        $name = $request['name'];
        $message = $request['message'];
        switch ($sms_sender->type) {
            case 'mokhaberat':
                $sms = Sms::create([
//                    'sms_sender_id' => $sms_sender->id,
                    'sms_sender_id' => 1,
                    'mobile' => $mobile,
                    'name' => $name,
                    'description' => $message
                ]);
                $this->setKeys();
                $this->sendOrdinarySmsMokhaberat([$mobile], ["name" => $request->name, 'body' => $message], $sms_sender->number, $sms->id);
                break;
        }
        return back()->with(['message' => 'sent'])->withInput();
    }

    //Communication Methods
    protected function comIndex()
    {
        $sms_senders = SmsSender::all();

        return view('admin.sms.communications.index', compact('sms_senders'));
    }

    protected function comCreate()
    {
        $sms_constant_titles = array_keys(config('constants.constants.sms'));
        return view('admin.sms.communications.create', compact('sms_constant_titles'));
    }

    protected function comStore(Request $request)
    {
        $sms_constant_titles_string = implode(',', array_keys(config('constants.constants.sms')));
        $request->validate([
            'title' => 'required|unique:sms_senders,title',
            'number' => 'required|numeric|unique:sms_senders,number',
            'service' => "required|unique:sms_senders,title|in:$sms_constant_titles_string",
        ]);
        SmsSender::create([
            'title' => $request['title'],
            'number' => $request['number'],
            'type' => $request['service'],
        ]);
        return back()->with(['store' => 'success']);
    }

    protected function comEdit(SmsSender $com)
    {
        $sms_constant_titles = array_keys(config('constants.constants.sms'));
        return view('admin.sms.communications.edit', compact('com', 'sms_constant_titles'));
    }

    protected function comUpdate(Request $request, SmsSender $com)
    {
        $sms_constant_titles_string = implode(',', array_keys(config('constants.constants.sms')));
        $request->validate([
            'title' => "required|unique:sms_senders,title,{$com->id}",
            'number' => "required|numeric|unique:sms_senders,number,{$com->id}",
            'service' => "required|unique:sms_senders,title,{$com->id}|in:$sms_constant_titles_string",
        ]);
        $com->update([
            'title' => $request['title'],
            'number' => $request['number'],
            'type' => $request['service'],
        ]);
        return back()->with(['update' => 'success']);
    }

    protected function comDestroy(SmsSender $com)
    {
        $com->smses()->forceDelete();
        $com->forceDelete();
        return back()->with(['destroy' => 'success']);
    }

    //Communication Methods
    protected function draftIndex()
    {
        $sms_drafts = SmsDraft::all();
        return view('admin.sms.drafts.index', compact('sms_drafts'));
    }

    protected function draftCreate()
    {
        return view('admin.sms.drafts.create');
    }

    protected function draftStore(Request $request)
    {
        $request->validate([
            'draft' => 'required',
        ]);
        SmsDraft::create([
            'description' => $request['draft'],
        ]);
        return back()->with(['store' => 'success']);
    }

    protected function draftEdit(SmsDraft $draft)
    {

        return view('admin.sms.drafts.edit', compact('draft'));
    }

    protected function draftUpdate(Request $request, SmsDraft $draft)
    {
        $request->validate([
            'draft' => 'required',
        ]);
        $draft->update([
            'description' => $request['draft'],
        ]);
        return back()->with(['update' => 'success']);
    }

    protected function draftDestroy(SmsDraft $draft)
    {
        $draft->forceDelete();
        return back()->with(['destroy' => 'success']);
    }

    protected function showSettings()
    {
        $services = array_keys(config('constants.constants.sms'));
        $sms_numbers = SmsSender::all();
        return view('admin.sms.settings.create', compact('services', 'sms_numbers'));
    }

    protected function updateOrCreateCredentials(Request $request)
    {
        $services = array_keys(config('constants.constants.sms'));
        $servicesString = implode(',', $services);
        $request->validate([
            'service' => 'required|in:' . $servicesString,
            'username' => 'required',
            'password' => 'required',
            'p_confirm_code' => 'required',
            'p_ticket' => 'required',
            'p_password' => 'required',
            'sms_sender' => 'required',
        ]);
        $resault =  SmsSetting::updateOrCreate([
            'title' => $request['service']
        ],[
            'title' => $request['service'],
            'username' => $request['username'],
            'password' => $request['password'],
            'p_confirm_code' => $request['p_confirm_code'],
            'p_ticket' => $request['p_ticket'],
            'p_password' => $request['p_password'],
            'p_notif' => $request['p_notif'],
            'sms_sender' => $request['sms_sender'],
        ]);
        return back()->with(['update' => 'success']);

    }

    protected function getCredentials(Request $request)
    {
        if ($request->ajax()) {
            $service = $request->input('service');
            $count = SmsSetting::where('title', $service)->get()->count();
            if ($count > 0) {
                $service = SmsSetting::where('title', $service)->first();
                $username = $service->username;
                $password = $service->password;
                $p_confirm_code = $service->p_confirm_code;
                $p_ticket = $service->p_ticket;
                $p_notif = $service->p_notif;
                $p_password = $service->p_password;
                return response()->json([
                    'username' => $username,
                    'password' => $password,
                    'p_confirm_code' => $p_confirm_code,
                    'p_ticket' => $p_ticket,
                    'p_notif' => $p_notif,
                    'p_password' => $p_password,
                ]);
            } else {
                return response()->json(['credentials' => 'empty']);
            }
        }
    }

    protected function showDeliveries()
    {
        $this->setKeys();
        return $this->getReports();
//        return html_entity_decode($this->getReports());
        // $reports=SmsDelivery::all();
        //return view('');
    }
}
