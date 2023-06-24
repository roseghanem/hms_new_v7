<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescuiptionReq extends Model
{
//    use HasFactory;
    protected  $fillable =[

        'scientific_name',
        'gag',
        'gag_unit',
        'quantity',
        'quantity_unit',
        'method_of_use',
        'req_date',
        'Treatment_Peroid',
        'visit_id',
        'drug_form_id',


    ];
    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
    public function drugForm()
    {
        return $this->belongsTo(DrugForms::class,'drug_form_id');
    }
}
