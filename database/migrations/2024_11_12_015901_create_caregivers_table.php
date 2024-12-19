<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaregiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caregivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // เชื่อมโยงกับตาราง users
            $table->text('specialization')->nullable(); // ความถนัดพิเศษของผู้ดูแล
            $table->decimal('latitude', 10, 8)->nullable(); // ตำแหน่งละติจูดของผู้ดูแล
            $table->decimal('longitude', 11, 8)->nullable(); // ตำแหน่งลองจิจูดของผู้ดูแล
            $table->decimal('rating', 3, 2)->default(0); // คะแนนรีวิว
            $table->integer('experience_years')->default(0); // ประสบการณ์การทำงาน (ปี)
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
        Schema::dropIfExists('caregivers');
    }
}

