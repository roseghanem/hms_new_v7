<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarInsurance extends Model
{
//    use HasFactory;
    protected $fillable = [
        'from_date',
        'to_date',
        'note',
        'price',
        'car_id',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
