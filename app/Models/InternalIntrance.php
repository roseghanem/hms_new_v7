<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalIntrance extends Model
{
//    use HasFactory;

    protected $fillable = [
        'in_date',
        'out_date',
        'doctor_diagnosiss',
        'patient_telephone',
        'division_id',
        'patient_id',
        'doctor_id',
        'hour_reservation',
    ];
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function division()
    {
        return $this->belongsTo(Division::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
