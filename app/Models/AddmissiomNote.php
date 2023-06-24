<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddmissiomNote extends Model
{
//    use HasFactory;
    protected $table = 'addmissiom_notes';
    protected  $fillable =[
        'date',
        'visit_id',
        'division_id',
        'notes',

    ];
    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
