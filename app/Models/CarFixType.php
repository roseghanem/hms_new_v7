<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarFixType extends Model
{
//    use HasFactory;
    protected $fillable = [
        'name',
    ];
    public function car_fix()
    {
        return $this->hasMany(CarFix::class);
    }
}
