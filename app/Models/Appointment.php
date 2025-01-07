<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'elderly_id',
        'caregiver_id',
        'doctor_id',
        'scheduled_at',
        'status',
        'notes',
    ];

    /**
     * Relationship with User as Elderly
     */
    public function elderly()
    {
        return $this->belongsTo(User::class, 'elderly_id');
    }

    /**
     * Relationship with User as Caregiver
     */
    public function caregiver()
    {
        return $this->belongsTo(User::class, 'caregiver_id');
    }

    /**
     * Relationship with User as Doctor
     */
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
