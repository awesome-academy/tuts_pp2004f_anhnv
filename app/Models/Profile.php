<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    public $timestamps = false;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'image_avatar',
        'phone',
        'address_line_1',
        'address_line_2',
        'city',
        'country',
        'person_id',
        'person_type',
    ];
}
