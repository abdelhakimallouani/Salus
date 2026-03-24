<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Doctor;

class Appointment extends Model
{
    protected $fillable = [
        'user_id',
        'doctor_id',
        'appointment_date',
        'status',
        'notes',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
    
}
