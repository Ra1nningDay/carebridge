<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caregiver extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialization',
        'latitude',
        'longitude',
        'rating',
        'experience_years',
        'status',
        'application_step', // เพิ่มฟิลด์นี้
    ];

    public function applicationSteps()
    {
        return $this->hasMany(ApplicationStep::class, 'caregiver_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function personalInfo()
    {
        return $this->hasOne(UserPersonalInfo::class, 'user_id', 'user_id');
    }

}
