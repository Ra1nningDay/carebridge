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
        Schema::create('health_checks', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->date('check_date');
        $table->integer('blood_pressure_sbp')->nullable(); // ความดันโลหิตตัวบน
        $table->integer('blood_pressure_dbp')->nullable(); // ความดันโลหิตตัวล่าง
        $table->float('fpg')->nullable();                 // ระดับน้ำตาลในเลือด (มก./ดล.)
        $table->boolean('fpg_risk')->nullable();          // สถานะเสี่ยงต่อโรคเบาหวาน
        $table->text('blood_test_results')->nullable();   // ผลตรวจเลือด
        $table->text('other_results')->nullable();        // ผลตรวจอื่น ๆ
        $table->string('hearing_left')->nullable()->comment('ผลการได้ยิน หูซ้าย: ได้ยิน/ไม่ได้ยิน');
        $table->string('hearing_right')->nullable()->comment('ผลการได้ยิน หูขวา: ได้ยิน/ไม่ได้ยิน');
        $table->integer('age')->nullable()->comment('อายุสำหรับการคัดกรองกระดูกพรุน');
        $table->float('weight')->nullable()->comment('น้ำหนักตัวสำหรับการคัดกรองกระดูกพรุน');
        $table->float('osta_index')->nullable()->comment('คะแนน OSTA index');
        $table->string('osteoporosis_risk')->nullable()->comment('ความเสี่ยงกระดูกพรุน: สูง/ปานกลาง/ต่ำ');
        $table->timestamps();
        
        // Foreign Key
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_checks');
    }
};
