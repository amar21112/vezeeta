<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    public $table = 'admins';
    protected $guarded = [];
    protected $hidden = [
        'password',
    ];
    public $timestamps = true;
}
