<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutPatient extends Model
{
//    use HasFactory;
    protected $fillable = [
        'patient_id',
        'blood_group_id' ,

    ];



    public function Patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function BloodGroup()
    {
        return $this->belongsTo(BloodGroup::class);
    }
    public function Visit()
    {
        return $this->hasMany(Visit::class);
    }
  }
