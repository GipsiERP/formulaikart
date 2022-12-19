<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Tracks;
use App\Models\Championships;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('data');
            $table->string('horario',5);

            $table->float('fee_value',10,2)->default(null)->nullable();

            $table->unsignedBigInteger('track_id');
            $table->foreign('track_id')->references('id')->on('tracks')->onDelete('cascade');

            $table->unsignedBigInteger('championships_id');
            $table->foreign('championships_id')->references('id')->on('championships')->onDelete('cascade');
            
            $table->integer('points_versao')->nullable();
            $table->boolean('finished')->default(null)->nullable();
            $table->boolean('status')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
