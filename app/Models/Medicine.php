<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
//    use HasFactory;
    protected $fillable=[
    'scientific_name',
    'arabic_name',
    'effective_components',
    'medicine_interactions',
    'indications',
    'dose',
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
