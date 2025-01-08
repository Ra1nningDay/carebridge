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
        Schema::create('eye_health', function (Blueprint $table) {
            $table->id();
            $table->foreignId('health_assessment_id')->constrained('health_assessments')->onDelete('cascade');
            $table->boolean('has_eye_issue')->default(false);
            $table->boolean('distance_vision_issue')->default(false);
            $table->boolean('near_vision_issue')->default(false);
            $table->boolean('cataract_risk_left')->default(false);
            $table->boolean('cataract_risk_right')->default(false);
            $table->boolean('glaucoma_risk_left')->default(false);
            $table->boolean('glaucoma_risk_right')->default(false);
            $table->boolean('macular_degeneration_left')->default(false);
            $table->boolean('macular_degeneration_right')->default(false);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eye_health');
    }
};
