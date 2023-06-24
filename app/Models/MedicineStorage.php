<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineStorage extends Model
{
//    use HasFactory;
    protected $fillable=[
        'num',
        'min',
        'max',
        'medicine_id',
        'medicine_commercial_form_id',
    ];
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
    public function medicine_commercial_form()
    {
        return $this->belongsTo(MedicineCommercialForm::class);
    }








}
