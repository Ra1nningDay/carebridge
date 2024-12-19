<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPersonalInfo extends Model
{
    use HasFactory;

    protected $table = 'user_personal_info';

    protected $fillable = [
        'user_id',
        'date_of_birth',
        'gender',
        'phone',
        'address',
        'medical_history',
        'allergies',
        'medications',
        'care_type',
        'preferred_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
