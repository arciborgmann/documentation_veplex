<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/* 
    Rodar o seeder para popular os campos 
    php artisan db:seed --class=TabelaSeeder
*/

class TabelaSeeder extends Seeder
{
     public function run()
    {
        DB::statement('PRAGMA foreign_keys = OFF'); // Desabilita as foreign keys
        DB::table('tabela')->truncate();           // Limpa os registros da tabela
        DB::statement('PRAGMA foreign_keys = ON'); // Reativa as foreign keys
        
        // Inserindo a tabela despesa_produto
        DB::table('tabela')->insert([
            [
                'nome' => 'despesa_produto',
                'descricao' => 'Tabela com os dados de despesa_produto'
            ],
        ]);

        // Inserindo a tabela despesa_participacao
        DB::table('tabela')->insert([
            [
                'nome' => 'despesa_participacao',
                'descricao' => 'Tabela com os dados de despesa_participacao'
            ],
        ]);

        //Inserindo a tabela despesa_historico
        DB::table('tabela')->insert([
            [
                'nome' => 'despesa_historico',
                'descricao' => 'Tabela com os dados de despesa_historico'
            ],
        ]);

        //Inserindo a tabela cstb
        DB::table('tabela')->insert([
            [
                'nome' => 'cstb',
                'descricao' => 'Tabela com os dados de cstb'
            ],
        ]);
        
    }
}

