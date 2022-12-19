<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_configs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nameFull');
            $table->string('pu');
            $table->string('color_rgb');
            $table->string('color_hex');
            $table->string('logo_team');
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
        Schema::dropIfExists('team_configs');
    }
};
