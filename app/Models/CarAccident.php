<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarAccident extends Model
{
//    use HasFactory;
    protected $fillable = [
    'date',
    'description',
    'driver_id',
    'car_id',
];
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
