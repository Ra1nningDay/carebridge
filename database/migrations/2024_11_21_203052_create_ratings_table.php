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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluation_topic_id')->constrained('evaluation_topics'); // เชื่อมกับหัวข้อ
            $table->integer('stars'); // คะแนน (1-5)
            $table->text('feedback')->nullable(); // ความคิดเห็นเพิ่มเติม
            $table->unsignedBigInteger('user_id')->nullable(); // ผู้ใช้ (ถ้ามี)
            $table->timestamps();

            $table->foreign('evaluation_topic_id')->references('id')->on('evaluation_topics')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
