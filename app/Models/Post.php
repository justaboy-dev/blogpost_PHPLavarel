<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'tittle', 'slug', 'excerpt', 'body', 'user_id', 'category_id','public',
    ];

    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function images()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
