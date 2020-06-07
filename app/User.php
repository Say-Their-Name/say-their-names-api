<?php

namespace App;

use App\Models\Traits\HasBookmarks;
use App\Models\Traits\Unguarded;
use App\Notifications\ForgotPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;
    use Unguarded;
    use HasBookmarks;
    use HasApiTokens;

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
