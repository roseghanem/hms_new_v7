<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineSource extends Model
{
//    use HasFactory;
    protected $fillable=[
        'name',
        'details',
    ];
    public function medicine_lot()
    {
        return $this->hasMany(MedicineLot::class);
    }

}
