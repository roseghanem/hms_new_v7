<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalaysisReq extends Model
{
    protected $table = "analysis_reqs";
//    use HasFactory;
    protected  $fillable =[
        'date',
        'visit_id',
        'analaysis_category_id',
        'notes',

    ];
    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
    public function analaysis_category()
    {
        return $this->hasMany(AnalysisCategory::class);
    }
}
