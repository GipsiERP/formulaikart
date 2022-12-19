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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('posicao'); //"29"
            $table->integer('numero_kart'); //." => "029"
            $table->string('nome'); // WILLIAM"
            $table->string('categoria'); // => "LIGHT"
            $table->string('comentarios'); // => "19"
            $table->string('qtde_voltas'); // => "18:45.865"
            $table->string('total_tempo'); // => "47.718"
            $table->string('melhor_tempo'); // => "4 Laps"
            $table->string('diff'); // => "20.223"
            $table->string('espaco'); // => "20.223"
            $table->string('titulo_evento');

            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');

            $table->unsignedBigInteger('driver_id')->nullable();
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');

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
        Schema::dropIfExists('results');
    }
};
