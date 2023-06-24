<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineOutDestination extends Model
{
//    use HasFactory;
    protected $fillable=[
        'name',
        'details',
    ];
    public function medicine_lot_out()
    {
        return $this->hasMany(MedicineLotOut::class);
    }
}
