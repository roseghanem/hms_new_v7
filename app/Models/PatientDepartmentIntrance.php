<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDepartmentIntrance extends BaseModel
{
//    use HasFactory;
    protected $fillable = [
        'note',
        'visit_date' ,
        'patient_id' ,
        'department_id' ,

        'referral_number' ,
        'referral_date' ,
        'bill_number' ,
        'bill_date' ,
        'doctor_diagnosiss' ,
        'drugs' ,
        'intrance' ,
    ];



    protected $allowedFilters = [
        'visit_date', 'patient_id', 'department_id'
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
