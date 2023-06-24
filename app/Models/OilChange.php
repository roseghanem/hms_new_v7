<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OilChange extends Model
{
//    use HasFactory;

    protected $fillable = [
        'change_date',
        'old_kilometrage',
        'new_kilometrage',
        'oil_type',
        'quantity',
        'filter',
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
