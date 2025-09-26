<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSpecialist extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
