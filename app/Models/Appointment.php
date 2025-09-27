<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public $table = 'appointments';
    protected $guarded = [];
    public $timestamps = false;

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient(){
        return $this->belongsTo(User::class,'user_id');
    }
}
