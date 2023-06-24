<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
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
        'address' ,
    ];
    public function internal_intrance()
    {
        return $this->hasMany(InternalIntrance::class);
    }
    public function visit()
    {
        return $this->hasMany(Visit::class);
    }
 /*   public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }*/

}
