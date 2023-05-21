<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Models\TotalScore;
use App\Models\User;
use Illuminate\Http\Request;
use function auth;
use function response;

class LikeController extends Controller
{
    public function like(Request $request, Reply $reply)
    {
        User::find(auth()->id())->like($reply);
        TotalScore::create([
            'user_id'=>$reply->user_id,
            'score' => 1,
            'type' => 1
        ]);
//        return response()->json(['message' => 'Success']);
        return back();
    }


    public function unlike(Request $request, Reply $reply)
    {
        User::find(auth()->id())->unlike($reply);
        TotalScore::create([
            'user_id'=>$reply->user_id,
            'score' => 1,
            'type' => 0
        ]);
//        return response()->json(['message' => 'Success']);
        return back();
    }


    public function dislike(Request $request, Reply $reply)
    {
        User::find(auth()->id())->dislike($reply);
        TotalScore::create([
            'user_id'=>$reply->user_id,
            'score' => 1,
            'type' => 0
        ]);
//        return response()->json(['message' => 'Success']);
        return back();
    }

}

