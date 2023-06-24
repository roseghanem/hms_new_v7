<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends BaseModel
{
//    use HasFactory;
    protected $fillable = [
    'name',
    'phone' ,
    'department_id' ,
];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function visit()
    {
        return $this->hasMany(Visit::class);
    }
}
