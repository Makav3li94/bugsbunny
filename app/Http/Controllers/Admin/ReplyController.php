<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Models\Setting;
use App\Models\TotalScore;
use App\Traits\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReplyController extends Controller
{
    use Helpers;

    public function index()
    {
        $replies = Reply::with(['section', 'user'])->orderBy('id','desc')->get();
        return view('admin.replies.index', compact('replies'));
    }

    public function edit(Reply $reply, Request $request)
    {
        if ($request->ajax()) {
            return response()->json(['reply' => $reply]);
        }
    }

    public function update(Request $request, Reply $reply)
    {
        if (isset($request->update_type)) {
            $prev = $reply->status;
            if ($prev == 0) {
                $setting = Setting::all()->first();

                $count = TotalScore::where([['is_for' ,'reply'], ['model_id' , $reply->id]])->get()->count();
                if ($count == 0) {
                    TotalScore::create([
                        'user_id' => auth()->id(),
                        'score' => $setting->reply_score,
                        'type' => 1,
                        'is_for' => 'reply',
                        'model_id' => $reply->id
                    ]);
                }
            }else{
                $count = TotalScore::where([['is_for' ,'reply'], ['model_id' , $reply->id]])->get()->count();
                if ($count == 1) {
                    TotalScore::where([['user_id',$reply->user_id],['type',1],['is_for' , 'reply'], ['model_id' , $reply->id]])->delete();
                }
            }
            $reply->update(['status' => $prev == 1 ? 0 : 1]);


            $this->readMFNotification($reply->user_id, 'reply', $reply->id);
            return redirect()->back()->with(['update' => 'success']);
        }

        $validator = Validator::make($request->all(), [
            'body' => "required"
        ]);
        if ($validator->fails()) {
            return response()->json(['collapseReplyError' => $validator->errors()->toArray()]);
        }
        $body = $request->input('body');
        $this->readMFNotification($reply->user_id, 'reply', $reply->id);

        $reply->update([
            'body' => $body,
        ]);

        $reply = [
            0 => $reply->body,
            1 => $reply->id
        ];
        return response()->json(['collapseReplyEdit' => 'success', 'reply' => $reply]);
    }

    public function destroy(Reply $reply)
    {
        $this->readMFNotification($reply->user_id, 'reply', $reply->id);
        $reply->delete();
        return redirect()->back()->with(['delete' => 'success']);
    }
}
