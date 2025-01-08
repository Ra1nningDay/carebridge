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
        Schema::create('cognitive_screenings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('geriatric_screening_id')->constrained('geriatric_screenings')->onDelete('cascade');
            $table->string('question'); // ใส่คำถาม เช่น "อายุเท่าไหร่"
            $table->string('answer');   // ใส่คำตอบ เช่น "ถูก/ผิด"
            $table->timestamps(); // บันทึก created_at และ updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('cognitive_screenings');
    }

};
