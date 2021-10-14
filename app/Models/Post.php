<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['user_id', 'category_id', 'avatar', 'title', 'description', 'content', 'price', 'status'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {

        return $this->belongsTo(Category::class);
    }

    
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
}
