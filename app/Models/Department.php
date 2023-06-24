<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends BaseModel
{
//    use HasFactory;
    protected $fillable = [
        'name',
        'phone' ,
    ];

    public function patientDepartmentIntrance()
    {
        return $this->hasMany(PatientDepartmentIntrance::class);
    }


    public function clinic()
    {
        return $this->hasMany(Clinic::class);
    }
    public function division()
    {
        return $this->hasMany(Division::class);
    }
    protected $allowedFilters = [
        'name',
    ];
}
