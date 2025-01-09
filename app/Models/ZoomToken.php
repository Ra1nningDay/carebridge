<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomToken extends Model
{
    use HasFactory;

    // ระบุชื่อตารางที่ Model เชื่อมโยง
    protected $table = 'zoom_tokens';

    // ระบุว่าตารางนี้ใช้ Primary Key แบบ Auto-Increment
    protected $primaryKey = 'id';

    // ระบุฟิลด์ที่สามารถเพิ่มหรืออัปเดตได้
    protected $fillable = [
        'user_id',
        'access_token',
        'refresh_token',
        'expires_at',
    ];

    // ระบุฟิลด์ที่เป็นประเภทวัน/เวลา
    protected $dates = ['expires_at', 'created_at', 'updated_at'];

    // สร้างความสัมพันธ์กับ Model Users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
