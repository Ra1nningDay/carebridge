<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->ipAddress('ip_address')->nullable(); // IP Address ของผู้เข้าชม
            $table->string('user_agent')->nullable(); // ข้อมูล User Agent
            $table->timestamp('visited_at')->useCurrent(); // เวลาที่เข้าชม
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('visits');
    }
}
