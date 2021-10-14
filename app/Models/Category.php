<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'avatar',
        'active',

    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }

    
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($category) { // before delete() method call this
            $category->posts()->delete();

            
        });
    }
}
