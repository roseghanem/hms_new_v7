<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyNotification extends Model
{
//    use HasFactory;
    protected $fillable = [
        'title',
        'details',
        'date',
    ];
}
