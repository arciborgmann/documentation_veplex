<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropClienteSituacaoTableV3 extends Migration
{
    public function up()
    {
        Schema::dropIfExists('cliente_situacao');
    }

    public function down()
    {
        Schema::create('cliente_situacao', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->timestamps();
            // Adicione outras colunas conforme necessário
        });
    }
}


