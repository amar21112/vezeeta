<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    use HasFactory;
    protected $table = 'specialists';
    protected $guarded = [];

    public function doctors()
    {
        return $this->belongsToMany('App\Models\Doctor' , 'doctor_specialists' ,'specialist_id' ,'doctor_id' );
    }
}
