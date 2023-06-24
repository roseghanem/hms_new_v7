<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineCommercialForm extends Model
{
//    use HasFactory;
    protected $fillable=[
        'name',
        'capacity',
        'unit',
        'note',
    ];
    public function medicine_lot()
    {
        return $this->hasMany(MedicineLot::class);
    }
    public function medicine_storage()
    {
        return $this->hasMany(MedicineStorage::class);
    }
    public function medicine_lot_out()
    {
        return $this->hasMany(MedicineLotOut::class);
    }
}
