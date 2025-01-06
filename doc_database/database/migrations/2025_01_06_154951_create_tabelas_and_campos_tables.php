<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabelasAndCamposTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tabela 'tabelas'
        Schema::create('tabelas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->timestamps();
        });

        // Tabela 'campos'
        Schema::create('campos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tabela_id');
            $table->string('nome');
            $table->string('tipo');
            $table->text('descricao')->nullable();
            $table->boolean('is_primary_key')->default(false);
            $table->timestamps();

            $table->foreign('tabela_id')->references('id')->on('tabelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campos');
        Schema::dropIfExists('tabelas');
    }
}
