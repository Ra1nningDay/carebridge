<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // ใช้ traits HasFactory และ Notifiable เพื่อสนับสนุนฟีเจอร์ต่างๆ ใน Laravel
    use HasFactory, Notifiable;

    // กำหนด attribute ที่สามารถถูกเติมค่าได้ผ่าน mass assignment
    protected $fillable = [
        'name',           // ชื่อของผู้ใช้
        'citizen_id',     // รหัสประชาชน
        'email',          // อีเมล
        'password',       // รหัสผ่าน
        'avatar',         // รูปโปรไฟล์ (avatar)
    ];

    // กำหนดค่า attribute ที่จะซ่อนในการแสดงผล (เช่น ข้อมูลที่ไม่ต้องการให้แสดง)
    protected $hidden = [
        'password',       // ซ่อนรหัสผ่าน
        'remember_token', // ซ่อน remember_token
    ];

    // กำหนดประเภทของ attribute ที่ต้องการแปลงเมื่อดึงข้อมูลจากฐานข้อมูล
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // แปลง email_verified_at เป็น datetime
            'password' => 'hashed',           // แปลง password เป็น hashed เพื่อรักษาความปลอดภัย
        ];
    }

    // Accessor สำหรับ avatar_url
    // ใช้เพื่อดึง URL ของ avatar
    public function getAvatarUrlAttribute()
    {
        // ตรวจสอบว่ามี avatar หรือไม่
        if ($this->avatar) {
            return asset('uploads/avatars/' . $this->avatar);  // หากมี avatar ให้แสดงไฟล์ avatar ที่อัปโหลด
        }

        // หากไม่มี avatar ให้แสดงภาพ default
        return asset('images/avatars/default-avatar.png'); // แสดงภาพ default เมื่อไม่มี avatar
    }

    // ความสัมพันธ์ระหว่าง User กับ UserPersonalInfo (ข้อมูลส่วนตัวของผู้ใช้)
    public function personalInfo()
    {
        return $this->hasOne(UserPersonalInfo::class, 'user_id', 'id');
    }

    // ความสัมพันธ์ระหว่าง User กับ UserPhysical (ข้อมูลทางกายภาพของผู้ใช้)
    public function physicalInfo()
    {
        return $this->hasMany(UserPhysical::class);
    }

    // ความสัมพันธ์ระหว่าง User กับ Role (บทบาทของผู้ใช้)
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    // ความสัมพันธ์ระหว่าง User กับ Post (โพสต์ที่ผู้ใช้สร้าง)
    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }
    
    // ความสัมพันธ์ระหว่าง User กับ Caregiver (การเชื่อมโยงข้อมูลผู้ดูแลของผู้ใช้)
    public function caregiver()
    {
        return $this->belongsToMany(User::class, 'elderly_caregiver', 'elderly_id', 'caregiver_id');
    }

    // ความสัมพันธ์ระหว่าง User กับ Elderly (การเชื่อมโยงผู้สูงอายุที่ผู้ใช้ดูแล)
    public function elderly()
    {
        return $this->belongsToMany(User::class, 'elderly_caregiver', 'caregiver_id', 'elderly_id');
    }

    // ความสัมพันธ์ระหว่าง User กับ HealthCheck (การตรวจสุขภาพของผู้ใช้)
    public function healthChecks()
    {
        return $this->hasMany(HealthCheck::class, 'user_id', 'id');
    }

    // ความสัมพันธ์ระหว่าง User กับ Conversation (การสนทนาของผู้ใช้)
    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'conversation_user');
    }

    // ความสัมพันธ์ระหว่าง User กับ Message (ข้อความที่ผู้ใช้ส่ง)
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
