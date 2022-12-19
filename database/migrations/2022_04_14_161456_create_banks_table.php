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
        Schema::create('banks', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('agencia');
            $table->string('conta');
            $table->string('contato_name');
            $table->string('contato_telefone');
            $table->string('contato_celular');
            $table->string('contato_email');
            $table->string('codigo');
            $table->boolean('bank_principal')->default(false);
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
        Schema::dropIfExists('banks');
    }
};
