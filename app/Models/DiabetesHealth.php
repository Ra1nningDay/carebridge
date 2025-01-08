<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiabetesHealth extends Model
{
    use HasFactory;

    protected $fillable = [
        'health_assessment_id',
        'diabetes_status',
        'fpg',
        'random_glucose',
    ];

    public function healthAssessment()
    {
        return $this->belongsTo(HealthAssessment::class);
    }
}
