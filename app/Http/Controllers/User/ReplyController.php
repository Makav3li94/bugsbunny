<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Models\Setting;
use App\Models\TotalScore;
use App\Models\User;
use App\Traits\Helpers;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    use Helpers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|string'
        ]);

        $reply=Reply::create([
            'user_id' => auth()->id(),
            'parent_id' => isset($request->parent_id) ? $request->parent_id : 0,
            'section_id' => $request->section_id,
            'body' => $request->body,
            'status' => 0
        ]);
        $setting = Setting::all()->first();
        $user  = User::find(auth()->id());
        $this->notifyAdmin($user->id, $user->name, $user->mobile, 'reply', $reply->id, 0,'کاربر کامنت جدیدی ارسال کرده است.');
        TotalScore::create([
            'user_id'=>auth()->id(),
            'score' => $setting->reply_score,
            'type' => 1,
            'is_for'=>'reply'
        ]);
        return redirect()->back()->with(['store'=>'success']);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Reply $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Reply $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Reply $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reply $reply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Reply $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        //
    }
}
