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
        'status'
    ];

    use SoftDeletes;
    protected $date = ['deleted_at'];
}
