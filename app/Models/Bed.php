<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
//    use HasFactory;
    protected $fillable = [
        'code',
        'location',
        'status',
        'room_id',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}

