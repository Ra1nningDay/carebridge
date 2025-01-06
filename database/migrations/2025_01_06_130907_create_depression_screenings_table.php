<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('depression_screenings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('geriatric_screening_id')->constrained('geriatric_screenings')->onDelete('cascade');
            $table->string('question'); // ใส่คำถาม เช่น "รู้สึกหดหู่ เศร้า"
            $table->enum('answer', ['yes', 'no']); // เก็บคำตอบเป็น yes หรือ no
            $table->timestamps(); // บันทึก created_at และ updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('depression_screenings');
    }

};
