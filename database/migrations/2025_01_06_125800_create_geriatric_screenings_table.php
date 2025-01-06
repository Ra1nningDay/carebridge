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
        Schema::create('geriatric_screenings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('health_assessment_id')->constrained()->onDelete('cascade');
            $table->text('cognitive_status');
            $table->text('depression_status');
            $table->text('knee_osteoarthritis_status');
            $table->text('fall_risk_status');
            $table->text('incontinence_status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('geriatric_screenings');
    }

};
