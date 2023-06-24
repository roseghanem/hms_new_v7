<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScanRequest extends Model
{
//    use HasFactory;
    protected  $fillable =[
        'req_date',
        'pregnant_woman',
        'patient_preparation',
        'part_of_body_id',
        'scan_unit_id',
        'visit_id',
    ];

    public function partOfBody(){
        return $this->belongsTo(PartOfBody::class);
    }
         public function scanUnit()
    {
        return $this->belongsTo(ScanUnit::class);
    }
    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
}
