<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'recorded_by',
    ];

    // ใน Model HealthAssessment
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // ความสัมพันธ์แบบ One-to-Many กับโมเดลอื่น ๆ
    public function hypertensionHealth()
    {
        return $this->hasOne(HypertensionHealth::class);
    }

    public function diabetesHealth()
    {
        return $this->hasOne(DiabetesHealth::class);
    }

    public function oralHealth()
    {
        return $this->hasOne(OralHealth::class);
    }

    public function eyeHealth()
    {
        return $this->hasOne(EyeHealth::class);
    }
    
    // ฟังก์ชันความสัมพันธ์ของ recorded_by
    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
