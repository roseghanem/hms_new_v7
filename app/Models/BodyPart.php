<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodyPart extends Model
{
//    use HasFactory;
    protected $table ="part_of_bodies";
    protected $fillable = [
        'name',
    ];

}
