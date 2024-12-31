<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElderlyCaregiverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elderly_caregiver', function (Blueprint $table) {
            $table->id();

            // ฟิลด์สำหรับ user_id ที่เชื่อมโยงกับผู้สูงอายุ
            $table->foreignId('elderly_id')
                  ->constrained('users') // เชื่อมกับตาราง users
                  ->onDelete('cascade');  // ลบเมื่อผู้สูงอายุถูกลบ

            // ฟิลด์สำหรับ user_id ที่เชื่อมโยงกับผู้ดูแล
            $table->foreignId('caregiver_id')
                  ->constrained('users') // เชื่อมกับตาราง users
                  ->onDelete('cascade');  // ลบเมื่อผู้ดูแลถูกลบ

            // สร้าง Unique Key สำหรับป้องกันความสัมพันธ์ซ้ำซ้อน
            $table->unique(['elderly_id', 'caregiver_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('elderly_caregiver');
    }
}
