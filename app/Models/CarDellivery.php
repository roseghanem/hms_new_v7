<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarDellivery extends Model
{
//    use HasFactory;
    protected $fillable = [
        'from_date',
        'to_date',
        'description',
        'accesories',
        'sub_accesories',
        'note',
        'out_state',
        'in_state',
        'engine_state',
        'tires_state',
        'driver_id',
        'car_id',
        'car_dellivery_type_id',
        'electricity_state',
        'battery_state',
        'dozan_state',
        'light_state',
        'tire_size',
        'delliver_person',
        'tire_date',
        'kilometrage',
    ];
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    public function car_dellivery_type()
    {
        return $this->belongsTo(CarDelliveryType::class);
    }
}
