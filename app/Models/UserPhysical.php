<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPhysical extends Model
{
    protected $table = 'user_physical';

    protected $fillable = [
        'user_id',
        'height',
        'weight',
        'blood_type'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
