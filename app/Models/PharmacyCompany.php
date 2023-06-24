<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyCompany extends Model
{
//    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'nationality',
    ];
    public function medicine_lot()
    {
        return $this->hasMany(MedicineLot::class);
    }
}
