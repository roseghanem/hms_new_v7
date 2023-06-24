<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkShift extends Model
{
//    use HasFactory;
    protected $fillable = [
        'date',
        'year' ,
        'month' ,
    ];
    public function driver_shift()
    {
        return $this->hasMany(DriverShift::class);
    }
    public function drivers()
    {
        return $this->belongsToMany(Driver::class);
    }
}
