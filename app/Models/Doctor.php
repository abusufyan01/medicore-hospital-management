<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
              'name',
              'email',
              'phone',
              'specialization',
              'qualification',
              'start_time', 
              'end_time'

    ];

    public function appointments(){
        
    return $this->hasMany(Appointment::class);
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
}
