<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OralHealth extends Model
{
    use HasFactory;

    protected $fillable = [
        'health_assessment_id',
        'brushing_frequency',
        'brushing_other',
        'uses_toothpaste',
        'cleans_between_teeth',
        'cleaning_tool',
        'smokes_more_than_10',
        'chews_areca',
    ];

    public function healthAssessment()
    {
        return $this->belongsTo(HealthAssessment::class);
    }
}
