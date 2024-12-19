<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyAnswer extends Model
{
    use HasFactory;

    // กำหนดตารางที่ Model ใช้งาน
    protected $table = 'survey_answers';

    // กำหนดฟิลด์ที่สามารถเพิ่มหรือแก้ไขได้
    protected $fillable = [
        'assessment_id',
        'question_id',
        'user_id',
        'answer',
    ];

    // ความสัมพันธ์กับตาราง assessments
    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    // ความสัมพันธ์กับตาราง questions
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // ความสัมพันธ์กับตาราง users (ถ้ามี)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor สำหรับแปลง JSON เป็น Array เมื่ออ่านค่าจากฐานข้อมูล
    public function getAnswerAttribute($value)
    {
        return json_decode($value, true); // แปลง JSON เป็น Array
    }

    // Mutator สำหรับแปลง Array เป็น JSON ก่อนบันทึกลงฐานข้อมูล
    public function setAnswerAttribute($value)
    {
        $this->attributes['answer'] = json_encode($value); // แปลง Array เป็น JSON
    }
}
