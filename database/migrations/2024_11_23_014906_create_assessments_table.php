<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentsTable extends Migration
{
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // ชื่อแบบประเมิน
            $table->text('description')->nullable(); // คำอธิบาย
            $table->timestamps(); // created_at และ updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('assessments');
    }
}

