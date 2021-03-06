<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommentLike;
use App\Models\Comment;
use Teapot\StatusCode\All;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        
        // try {
            $like=CommentLike::all();
           

            $success = 1;

            if (Auth()->check()) {
                $like_check = CommentLike::where('user_id', '=', Auth::user()->id)
                    ->where('comment_id', '=', $request->comment_id)
                    ->get();
                //  return $like_check->count();
                if ($like_check->count() === 0) {
                    
                    $like = CommentLike::create(['user_id' => Auth::user()->id, 'comment_id' => $request->comment_id]);
                   
                } else $success = 0;
                $comment = Comment::find($request->comment_id);
                $count = $comment->likes->count();
                return [$success, $count];
            } else $success = 2;

            return [$success];
        // } catch (\Illuminate\Database\QueryException $ex) {
        //     return view('errors');
        // }
    }
}
