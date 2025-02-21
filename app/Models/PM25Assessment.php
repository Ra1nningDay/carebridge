<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PM25Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'recorded_by',
        'risk_level',
        'question1',
        'question2',
        'question3',
        'question4',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
