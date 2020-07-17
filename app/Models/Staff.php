<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'staffs';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'email',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $guard = 'admin';

    public function post()
    {
        return $this->belongsToMany(Post::class)->withPivot('post_id', 'staff_id');
    }
}
