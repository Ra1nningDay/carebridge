<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['evaluation_topic_id', 'stars', 'feedback', 'user_id'];

    public function topic()
    {
        return $this->belongsTo(EvaluationTopic::class, 'evaluation_topic_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

