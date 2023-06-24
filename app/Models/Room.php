<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
//    use HasFactory;

    protected $fillable = [
        'code',
        'phone',
        'details',
        'total_beds',
        'taken_beds',
        'division_id',
    ];
    public function division()
    {
        return $this->belongsTo(Division::class);
    }
    public function beds()
    {
        return $this->hasMany(Bed::class);
    }
}
