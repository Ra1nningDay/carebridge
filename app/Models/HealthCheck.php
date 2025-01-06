<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthCheck extends Model
{
    use HasFactory;

    // ตารางที่ใช้
    protected $table = 'health_checks';

    // กำหนดฟิลด์ที่สามารถกรอกข้อมูลได้
    protected $fillable = [
        'user_id',
        'check_date',
        'recorded_by',
        'blood_pressure_sbp',
        'blood_pressure_dbp',
        'fpg',
        'fpg_risk',
        'blood_test_results',
        'other_results',
        'hearing_left',
        'hearing_right',
        'age',
        'weight',
        'osta_index',
        'osteoporosis_risk',
    ];

    // ความสัมพันธ์กับตาราง User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
