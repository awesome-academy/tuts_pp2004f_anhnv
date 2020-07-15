<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'parent_id',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public static function categorySelect()
    {
        return static::pluck('name', 'id');
    }
}
