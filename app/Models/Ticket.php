<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable = [
        'title',
        'content',
        'slug',
        'status',
        'user_id'
    ];

    use SoftDeletes;
    protected $date = ['deleted_at'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->hasOneThrough('App\User', Comment::class);
    }
}
