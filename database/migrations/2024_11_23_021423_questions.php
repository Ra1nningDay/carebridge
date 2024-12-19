<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // สร้างตาราง questions
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained()->onDelete('cascade'); // เชื่อมกับ assessments
            $table->text('question_text'); // ข้อความคำถาม
            $table->string('question_type'); // ประเภทคำถาม เช่น text, radio, select
            $table->json('options')->nullable(); // ตัวเลือกคำตอบในรูป JSON (เช่น ["Yes", "No"])
            $table->timestamps(); // created_at และ updated_at
        });

        // สร้างตาราง responses
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained()->onDelete('cascade'); // เชื่อมกับ assessments
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // เชื่อมกับ users (ถ้ามีระบบผู้ใช้)
            $table->json('response_data'); // คำตอบทั้งหมดในรูป JSON
            $table->timestamps(); // created_at และ updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // ลบตาราง responses ก่อน
        Schema::dropIfExists('responses');
        // ลบตาราง questions
        Schema::dropIfExists('questions');
    }
};
