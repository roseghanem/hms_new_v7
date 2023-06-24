<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineOutType extends Model
{
//    use HasFactory;
    protected $fillable=[
        'name',
    ];
    public function medicine_lot_out()
    {
        return $this->hasMany(MedicineLotOut::class);
    }
}
