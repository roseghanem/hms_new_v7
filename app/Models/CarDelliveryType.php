<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarDelliveryType extends Model
{
//    use HasFactory;
    protected $fillable = [
    'name',
    ];
    public function car_dellivery()
    {
        return $this->hasMany(CarDellivery::class);
    }
}
