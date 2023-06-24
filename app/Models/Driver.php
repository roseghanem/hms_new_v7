<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
 //   use HasFactory;

    protected $fillable = [
        'name',
        'national_number',
        'phone'
    ];
    public function car()
    {
        return $this->hasMany(CarTask::class);
    }
    public function car_dellivery()
    {
        return $this->hasMany(CarDellivery::class);
    }
    public function car_accident()
    {
        return $this->hasMany(CarAccident::class);
    }
    public function car_fix()
    {
        return $this->hasMany(CarFix::class);
    }
    public function driver_shift()
    {
        return $this->hasMany(DriverShift::class);
    }
    public function park_shifts()
    {
        return $this->belongsToMany(ParkShift::class);
    }
    public function oil_change()
    {
        return $this->hasMany(OilChange::class);
    }
}
