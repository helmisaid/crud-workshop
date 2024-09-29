<?php

namespace App\Http\Controllers;

use App\Models\PostComment;
use App\Models\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostCommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'comment_text' => 'required|string|max:255',
        ]);

        $comment = PostComment::create([
            'post_id' => $postId,
            'user_id' => auth()->id(), // Assuming user is logged in
            'comment_text' => $request->comment_text,
            'create_by' => auth()->id(), // Adjust as needed
        ]);

        return response()->json($comment);
    }

    public function index($postId)
    {
        $comments = PostComment::where('post_id', $postId)->with('user')->get();
        return response()->json($comments);
    }
}
