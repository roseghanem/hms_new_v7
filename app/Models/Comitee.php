<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comitee extends Model
{
//    use HasFactory;
    protected $fillable = [
        'from_date',
        'to_date',
        'note',
        'comitee_type_id',
    ];

    public function comitee_type()
    {
        return $this->belongsTo(ComiteeType::class);
    }
    public function car_fix()
    {
        return $this->hasMany(CarFix::class);
    }
}
