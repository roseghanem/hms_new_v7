<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
//    use HasFactory;
    protected $fillable = [
        'ar_name',
        'en_name',
        'code',
        'code_date',
        'specifications',
        'symptoms',
        'drugs',
    ];
}
