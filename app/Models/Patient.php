<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends BaseModel
{
//    use HasFactory;
    protected $fillable = [
        'first_name',
        'father_name' ,
        'last_name' ,
        'mother_name' ,
        'birth_place' ,
        'birth_date' ,
        'city' ,
        'code',
        'gender',
        'address',
        'national_number' ,
        'identity_number',
        'hospital_number',
        'address' ,
];
    public function patientDepartmentIntrance()
    {
        return $this->hasMany(PatientDepartmentIntrance::class);
    }
    public function internal_intrance()
    {
        return $this->hasMany(InternalIntrance::class);
    }

    public function patient_appointments()
    {
        return $this->hasMany(PatientAppointmentModel::class);
    }
}
