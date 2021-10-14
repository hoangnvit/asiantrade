<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CommentLike;

class Comment extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function likes()
    {

        return $this->hasMany(CommentLike::class);
    }
    // this is a recommended way to declare event handlers
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($comment) { // before delete() method call this
            $comment->replies()->delete();
            $comment->likes()->delete();
            // do the rest of the cleanup...
        });
    }
}
