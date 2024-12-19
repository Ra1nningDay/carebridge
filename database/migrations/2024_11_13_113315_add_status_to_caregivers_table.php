<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToCaregiversTable extends Migration
{
    public function up()
    {
        Schema::table('caregivers', function (Blueprint $table) {
            $table->string('status')->default('Pending')->after('experience_years');
        });
    }

    public function down()
    {
        Schema::table('caregivers', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
