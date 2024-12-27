<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'citizen_id',
        'email',
        'password',
        'avatar', // เพิ่ม avatar ใน fillable
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Accessor สำหรับ avatar_url
    public function getAvatarUrlAttribute()
    {
        // ตรวจสอบว่ามี avatar หรือไม่
        if ($this->avatar) {
            return asset('uploads/avatars/' . $this->avatar);
        }

        // หากไม่มี avatar ให้แสดงภาพ default
        return asset('images/avatars/default-avatar.png');
    }

    // ความสัมพันธ์กับ PersonalInfo
    public function personalInfo()
    {
        return $this->hasOne(UserPersonalInfo::class, 'user_id', 'id');
    }

    // ความสัมพันธ์กับ UserPhysical
    public function physicalInfo()
    {
        return $this->hasMany(UserPhysical::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }
    
    public function caregiver()
    {
        return $this->hasOne(Caregiver::class);
    }

    public function healthChecks()
    {
        return $this->hasMany(HealthCheck::class, 'user_id', 'id');
    }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'conversation_user');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
