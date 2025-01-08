<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('elderly_id');     // ผู้สูงอายุ
            $table->unsignedBigInteger('caregiver_id');   // ผู้ดูแล
            $table->unsignedBigInteger('doctor_id');      // หมอ
            $table->dateTime('scheduled_at');             // วันเวลานัดหมาย
            $table->enum('status', ['pending', 'confirmed', 'canceled', 'rescheduled'])
                ->default('pending');                     // สถานะ
            $table->text('notes')->nullable();            // รายละเอียดอาการเบื้องต้น
            $table->timestamps();

            // Foreign keys
            $table->foreign('elderly_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('caregiver_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
