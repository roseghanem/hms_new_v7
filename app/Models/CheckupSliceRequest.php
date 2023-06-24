<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckupSliceRequest extends Model
{
//    use HasFactory;

    protected  $fillable =[
        'req_date',
        'part_of_body_id',
        'scan_unit_id',
        'visit_id',
    ];

    public function partOfBody()
    {
        return $this->belongsTo(PartOfBody::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
}
