<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineLotOut extends Model
{
//    use HasFactory;
    protected $fillable=[
                        'code',
                        'export_date',
                        'medicine_id',
                        'medicine_commercial_form_id',
                        'medicine_out_destination_id',
                        'medicine_out_type_id',
                        ];
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
    public function medicine_commercial_form()
    {
        return $this->belongsTo(MedicineCommercialForm::class);
    }

    public function medicine_out_destination()
    {
        return $this->belongsTo(MedicineOutDestination::class);
    }
    public function medicine_out_type()
    {
        return $this->belongsTo(MedicineOutType::class);
    }
}
