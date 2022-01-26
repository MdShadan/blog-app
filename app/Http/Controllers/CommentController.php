<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    
    public function store(StoreCommentRequest $request)
    {
        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->user()->associate($request->user());
        $post = Post::find($request->post_id);
        $post->comments()->save($comment);

        return redirect()->back()->with('success', 'Comment added');
    }

    public function replyStore(StoreCommentRequest $request)
    {
        $reply = new Comment();
        $reply->comment = $request->comment;
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->comment_id;
        $post = Post::find($request->post_id);
        $post->comments()->save($reply);

        return redirect()->back()->with('success', 'Reply added');

    }
}

