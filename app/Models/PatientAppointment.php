<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAppointment extends Model
{
    use HasFactory;
    
    protected $table = 'patient_appointments';
    protected $fillable = ['user_id', 'doctor_id', 'appointment_id', 'status'];
    
    public function patient()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
    
    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }
}
