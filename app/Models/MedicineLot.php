<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineLot extends Model
{
//    use HasFactory;


    protected $fillable=[
            'code',
            'production_date',
            'expire_date',
            'insert_date',
            'medicine_source_id',
            'pharmacy_company_id',
           'medicine_id',
            'medicine_commercial_form_id',
    ];

    public function medicine_source()
    {
        return $this->belongsTo(MedicineSource::class);
    }
    public function pharmacy_company()
    {
        return $this->belongsTo(PharmacyCompany::class);
    }
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
    public function medicine_commercial_form()
    {
        return $this->belongsTo(MedicineCommercialForm::class);
    }

}
