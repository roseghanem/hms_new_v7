<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
//    use HasFactory;
    protected $fillable = [
        'type',
        'name',
        'number',
        'engine_number',
        'city',
        'weight',
        'color',
        'note',
        'year_of_production',
        'year_of_registration',
        'car_type_id',
        'fuel_type',
        'cylender_num',
        'cc_size',
        'fuel_size',
        'car_code',
        'chasse_number',
    ];
    public function car_type()
    {
        return $this->belongsTo(CarType::class);
    }
    public function car_task()
    {
        return $this->hasMany(CarTask::class);
    }
    public function car_accident()
    {
        return $this->hasMany(CarAccident::class);
    }
    public function car_fix()
    {
        return $this->hasMany(CarFix::class);
    }

    public function car_dellivery()
    {
        return $this->hasMany(CarDellivery::class);
    }

    public function car_insurance()
    {
        return $this->hasMany(CarInsurance::class);
    }

    public function oil_change()
    {
        return $this->hasMany(OilChange::class);
    }
}
