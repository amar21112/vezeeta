<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Doctor extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $guarded = [];
    public $timestamps = false;
    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
    ];
    public function specialties()
    {
        return $this->belongsToMany('App\Models\Specialist' , 'doctor_specialists', 'doctor_id', 'specialist_id');
    }
}
