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
        Schema::create('evaluation_topics', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // หัวข้อประเมิน เช่น "ความสวยงามของเว็บไซต์"
        $table->text('description')->nullable(); // รายละเอียดเพิ่มเติม
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_topics');
    }
};
