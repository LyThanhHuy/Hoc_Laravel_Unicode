<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $table = 'posts';

    public function categories()
    {
        return $this->belongsToMany(
            Categories::class,
            'categories_posts',
            'post_id',
            'category_id'
        );
        // ->withPivot('created_at', 'status')
        // ->wherePivot('status', 0);
    }

    public function comments()
    {
        return $this->hasMany(
            Comments::class,
            'post_id',
            'id'
        );
    }
}
