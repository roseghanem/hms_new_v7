<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
//    use HasFactory;
    protected $fillable = [
        'name',
        'total_beds',
        'taken_beds',
        'department_id',
        'phone'
    ];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function internal_intrances()
    {
        return $this->hasMany(InternalIntrance::class);
    }
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
