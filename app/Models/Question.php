<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['assessment_id', 'question_text', 'question_type', 'options'];

    protected $casts = [
        'options' => 'array', // แปลง JSON ในฐานข้อมูลเป็น Array
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
}

