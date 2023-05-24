<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReplyController extends Controller
{

    public function index()
    {
        $replies = Reply::with(['section', 'user'])->get();
        return view('admin.replies.index', compact('replies'));
    }

    public function edit(Reply $reply,Request $request){
        if ($request->ajax()) {
            return response()->json(['reply' => $reply]);
        }
    }

    public function update(Request $request, Reply $reply)
    {
        if (isset($request->update_type)) {
            $prev = $reply->status;
            $reply->update(['status' => $prev == 1 ? 0 : 1 ]);
        }
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'body' => "required"
            ]);
            if ($validator->fails()) {
                return response()->json(['collapseReplyError' => $validator->errors()->toArray()]);
            }
            $body = $request->input('body');
            $reply->update([
                'body' => $body,
            ]);
            $reply = [
                0 => $reply->body,
                1 => $reply->id
            ];
            return response()->json(['collapseReplyEdit' => 'success', 'reply' => $reply]);
        }
        return redirect()->back()->with(['update' => 'success']);
    }

    public function destroy(Reply $reply)
    {
        $reply->delete();
        return redirect()->back()->with(['delete' => 'success']);
    }
}
