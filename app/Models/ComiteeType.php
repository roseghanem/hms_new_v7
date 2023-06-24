<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComiteeType extends Model
{
//    use HasFactory;
    protected $fillable = [
        'name',
    ];
    public function comitee()
    {
        return $this->hasMany(Comitee::class);
    }
}
