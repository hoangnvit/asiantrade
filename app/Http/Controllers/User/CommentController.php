<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;


use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        try {
            $comment = new Comment;
            $comment->body = $request->get('comment_body');
            $comment->user()->associate($request->user());
            $post = Post::find($request->get('post_id'));
            $post->comments()->save($comment);

            return back();
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }

    public function replyStore(Request $request)
    {
        try {
            $reply = new Comment();
            $reply->body = $request->get('comment_body');
            $reply->user()->associate($request->user());
            $reply->parent_id = $request->get('comment_id');
            $post = Post::find($request->get('post_id'));

            $post->comments()->save($reply);

            return back();
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }

    public function comment_delete(int $i)
    {
        try {
            $user = auth()->user();
            $comment_delete = Comment::find($i);
            if ($user['id'] == $comment_delete->user_id) {


                $comment_delete->delete();
                return back();
            } else return redirect()->route('home');
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }

    public function comment_edit(Request $request)
    {
        try {
            $comment = Comment::find($request->get('comment_id'));
            $comment->body = $request->get('comment_body');
            $comment->save();
            return back();
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }
}
