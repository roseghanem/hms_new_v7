<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarTask extends Model
{
//    use HasFactory;
    protected $fillable = [
    'from_date',
    'to_date',
    'line',
    'length',
    'fuel',
    'driver_id',
    'car_id',
    'car_task_type_id',

    'kilo_start',
    'kilo_end',
    'responsible_person',
    'note',

];
    public function car_task_type()
    {
        return $this->belongsTo(CarTaskType::class);
    }
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
