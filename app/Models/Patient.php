<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
          'name',
          'email',
          'phone',
          'gender',
          'blood_group',
          'date_of_birth',
          'address',

    ];

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }

    public function medicalRecords (){
        return $this->hasMany(MedicalRecord::class);
    }
}
