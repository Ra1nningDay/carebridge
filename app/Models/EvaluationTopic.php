<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationTopic extends Model
{
    use HasFactory;
    protected $table = 'evaluation_topics';

    protected $fillable = ['title', 'description'];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
