<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarFix extends Model
{
//    use HasFactory;
    protected $fillable = [
        'date',
        'fix_place',
        'rubish_parts',
        'comitee_opinion',
        'fix_details',
        'fix_price',
        'description',
        'driver_id',
        'car_id',
        'car_fix_type_id',
        'comitee_id',
    ];
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function car_fix_type()
    {
        return $this->belongsTo(CarFixType::class);
    }

    public function comitee()
    {
        return $this->belongsTo(Comitee::class);
    }
}
