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
    public $timestamps = true;
    protected $hidden = [
        'password',
    ];
    public function specialties()
    {
        return $this->belongsToMany('App\Models\Specialist' , 'doctor_specialists', 'doctor_id', 'specialist_id');
    }

    public function appointments(){
        return $this->hasMany('App\Models\Appointment', 'doctor_id', 'id');
    }
}
