<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
//    use HasFactory;
    protected $fillable = [
        'date',
        'clinic_id',
        'disease_id',
        'out_patient_id',
        'doctor_id',
        'patient_history',      //القصة المرضية
        'medical_history',     // السوابق المرضية
        'surgical_history',   // السوابق الجراحية
        'family_history',     // السوابق العائلية
        'allergic_history',   // السوابق التحسسية
        'habits',            //العادات
        'scan_req_id',

    ];
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
    public function outPatient()
    {
        return $this->belongsTo(OutPatient::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function scanRequest()
    {
        return $this->hasMany(ScanRequest::class);
    }
    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }

}
