<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPersonalInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_personal_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // เชื่อมโยงกับตาราง users
            $table->date('date_of_birth')->nullable(); // วันเกิด
            $table->enum('gender', ['male', 'female', 'other'])->nullable(); // เพศ
            $table->string('phone')->nullable(); // เบอร์โทรศัพท์
            $table->string('address')->nullable(); // ที่อยู่
            $table->text('medical_history')->nullable(); // ประวัติการแพทย์
            $table->text('allergies')->nullable(); // อาการแพ้
            $table->text('medications')->nullable(); // ยาที่ใช้ประจำ
            $table->string('care_type')->nullable(); // ประเภทการดูแลที่ต้องการ
            $table->string('preferred_time')->nullable(); // เวลาที่สะดวก
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
        Schema::dropIfExists('user_personal_info');
    }
}
