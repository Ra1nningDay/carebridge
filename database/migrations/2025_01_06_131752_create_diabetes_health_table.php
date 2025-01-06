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
        Schema::create('diabetes_health', function (Blueprint $table) {
            $table->id();
            $table->foreignId('health_assessment_id')->constrained('health_assessments')->onDelete('cascade');
            $table->enum('diabetes_status', ['undiagnosed', 'treated', 'untreated']);
            $table->decimal('fpg', 5, 2)->nullable(); // Fasting plasma glucose
            $table->decimal('random_glucose', 5, 2)->nullable(); // Random glucose level
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diabetes_health');
    }
};
