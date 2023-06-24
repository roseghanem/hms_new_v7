<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientAppointmentModel extends Model
{
    protected $table = 'patients_appointment';
    protected $fillable = [
        'appointment_time',
        'payment_time',
        'is_temporary',
        'patient_id',
        'is_paid',
    ];

    public function Patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
