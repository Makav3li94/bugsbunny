<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Http\Request;
use function auth;
use function response;

class LikeController extends Controller
{
    public function like(Request $request, Reply $reply)
    {
        User::find(auth()->id())->like($reply);

        return response()->json(['message' => 'Success']);
    }

    public function unlike(Request $request, Reply $reply)
    {
        User::find(auth()->id())->unlike($reply);

        return response()->json(['message' => 'Success']);
    }

    public function dislike(Request $request, Reply $reply)
    {
        User::find(auth()->id())->dislike($reply);

        return response()->json(['message' => 'Success']);
    }
}
