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
        Schema::create('fall_risk_screenings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('geriatric_screening_id')->constrained('geriatric_screenings')->onDelete('cascade');
            $table->integer('time_taken'); // เวลาที่ใช้ เช่น ในหน่วยวินาที
            $table->string('assessment');  // การประเมิน เช่น "normal" หรือ "risk"
            $table->timestamps(); // บันทึก created_at และ updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('fall_risk_screenings');
    }

};
