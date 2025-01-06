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
        Schema::create('oral_health', function (Blueprint $table) {
            $table->id();
            $table->foreignId('health_assessment_id')->constrained('health_assessments')->onDelete('cascade');
            $table->enum('brushing_frequency', ['none', 'once_daily', 'twice_daily', 'more_than_twice_daily', 'other'])->default('none');
            $table->string('brushing_other')->nullable();
            $table->boolean('uses_toothpaste')->default(false);
            $table->boolean('cleans_between_teeth')->default(false);
            $table->string('cleaning_tool')->nullable();
            $table->boolean('smokes_more_than_10')->default(false);
            $table->boolean('chews_areca')->default(false);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oral_health');
    }
};
