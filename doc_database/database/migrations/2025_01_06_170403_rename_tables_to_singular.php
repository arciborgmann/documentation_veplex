<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTablesToSingular extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Renomeia as tabelas para o singular
        Schema::rename('tabelas', 'tabela');
        Schema::rename('campos', 'campo');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Volta os nomes originais
        Schema::rename('tabela', 'tabelas');
        Schema::rename('campo', 'campos');
    }
}
