<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'image_thumb',
        'excerpt',
        'content',
        'status',
        'category_id',
    ];
}
