<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverShift extends Model
{
//    use HasFactory;
    protected $fillable = [
        'driver_id',
        'park_shift_id' ,
    ];
    public function shift()
    {
        return $this->belongsTo(Driver::class);
    }
    public function park_shift()
    {
        return $this->belongsTo(ParkShift::class);
    }
}
