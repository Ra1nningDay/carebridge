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
        Schema::create('hypertension_health', function (Blueprint $table) {
            $table->id();
            $table->foreignId('health_assessment_id')->constrained('health_assessments')->onDelete('cascade');
            $table->enum('hypertension_status', ['undiagnosed', 'treated', 'untreated']);
            $table->integer('sbp')->nullable(); // Systolic blood pressure
            $table->integer('dbp')->nullable(); // Diastolic blood pressure
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hypertension_health');
    }
};
