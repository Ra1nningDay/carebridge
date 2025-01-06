<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HypertensionHealth extends Model
{
    use HasFactory;

    protected $fillable = [
        'health_assessment_id',
        'hypertension_status',
        'sbp',
        'dbp',
    ];

    public function healthAssessment()
    {
        return $this->belongsTo(HealthAssessment::class);
    }
}
