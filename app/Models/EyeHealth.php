<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EyeHealth extends Model
{
    use HasFactory;

    protected $fillable = [
        'health_assessment_id',
        'has_eye_issue',
        'distance_vision_issue',
        'near_vision_issue',
        'cataract_risk_left',
        'cataract_risk_right',
        'glaucoma_risk_left',
        'glaucoma_risk_right',
        'macular_degeneration_left',
        'macular_degeneration_right',
    ];

    public function healthAssessment()
    {
        return $this->belongsTo(HealthAssessment::class);
    }
}
