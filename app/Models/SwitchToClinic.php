<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwitchToClinic extends Model
{
//    use HasFactory;
    protected  $fillable =[
        'req_date',
        'visit_id',
        'clinic_id',
        'notes',

    ];
    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}


