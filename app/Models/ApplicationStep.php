<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'caregiver_id',
        'step_number',
        'status',
        'completed_at',
    ];

    // ความสัมพันธ์กับ Caregiver
    public function caregiver()
    {
        return $this->belongsTo(Caregiver::class);
    }
}
