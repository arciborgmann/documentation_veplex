<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Criar uma nova tabela 'campos_new' com a chave estrangeira
        Schema::create('campos_neww', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tabela_id')->constrained('tabela')->onDelete('cascade');
            $table->string('nome'); // Outros campos que sua tabela 'campos' possui
            $table->timestamps();
        });

        // Transferir os dados da tabela 'campos' para a tabela 'campos_new' (se necessário)
        DB::table('campo')->update(['tabela_id' => DB::raw('tabela_id')]); // Exemplo simples de transferir os dados

        // Excluir a tabela antiga 'campos'
        Schema::dropIfExists('campo');

        // Renomear a tabela 'campos_new' para 'campos'
        Schema::rename('campos_neww', 'campo');

        // Remover a tabela 'campos' e revertê-la
        Schema::dropIfExists('campos_new');
    }

    public function down()
    {
        // Remover a tabela 'campos' e revertê-la
        Schema::dropIfExists('campo');
    }
};