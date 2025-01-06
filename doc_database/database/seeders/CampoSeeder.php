<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/* 
    Rodar o seeder para popular os campos 
    php artisan db:seed --class=CampoSeeder
*/

class CampoSeeder extends Seeder
{
    public function run()
    {
        // Inserindo os campos para a tabela despesa_historico
        $this->inserirCamposDespesaHistorico();

        // Inserindo os campos para a tabela cstb
        $this->inserirCamposCstb();

        // Inserindo os campos para a tabela despesa_produto
        $this->inserirCamposDespesaProduto();

        // Inserindo os campos para a tabela despesa_participacao
        $this->inserirCamposDespesaParticipacao();
    }

    private function inserirCamposDespesaProduto() {
        $tabelaId = DB::table('tabela')->where('nome', 'despesa_produto')->first()->id;

        $campos = [
            ['tabela_id' => $tabelaId, 'nome' => 'cd_despesa_produto', 'tipo' => 'integer', 'descricao' => '', 'is_primary_key' => true],
            ['tabela_id' => $tabelaId, 'nome' => 'cd_despesa', 'tipo' => 'integer', 'descricao' => '', 'is_primary_key' => false],
            ['tabela_id' => $tabelaId, 'nome' => 'cd_produto', 'tipo' => 'bigint', 'descricao' => '', 'is_primary_key' => false],
            ['tabela_id' => $tabelaId, 'nome' => 'qt_produto', 'tipo' => 'numeric(10,3)', 'descricao' => '', 'is_primary_key' => false],
            ['tabela_id' => $tabelaId, 'nome' => 'vl_unitario', 'tipo' => 'numeric(10,3)', 'descricao' => '', 'is_primary_key' => false],
            ['tabela_id' => $tabelaId, 'nome' => 'vl_total', 'tipo' => 'numeric(10,2)', 'descricao' => '', 'is_primary_key' => false],
            ['tabela_id' => $tabelaId, 'nome' => 'ds_especificao', 'tipo' => 'text', 'descricao' => '', 'is_primary_key' => false],
            ['tabela_id' => $tabelaId, 'nome' => 'cd_despesa_historico', 'tipo' => 'integer', 'descricao' => '', 'is_primary_key' => false],
            ['tabela_id' => $tabelaId, 'nome' => 'vl_reembolso', 'tipo' => 'numeric(15,2)', 'descricao' => '', 'is_primary_key' => false],
            ['tabela_id' => $tabelaId, 'nome' => 'created_at', 'tipo' => 'timestamp', 'descricao' => 'Data de criação do registro', 'is_primary_key' => false],
            ['tabela_id' => $tabelaId, 'nome' => 'updated_at', 'tipo' => 'timestamp', 'descricao' => 'Data da última atualização do registro', 'is_primary_key' => false],
        ];
        $this->inserirCampos($campos);
    }

    private function inserirCamposDespesaHistorico()
    {
        $tabelaId = DB::table('tabela')->where('nome', 'despesa_historico')->first()->id;

        $campos = [
            ['tabela_id' => $tabelaId, 'nome' => 'cd_despesa_historico', 'tipo' => 'integer', 'descricao' => '', 'is_primary_key' => true],
            ['tabela_id' => $tabelaId, 'nome' => 'nm_despesa_historico', 'tipo' => 'text', 'descricao' => '', 'is_primary_key' => false],
            ['tabela_id' => $tabelaId, 'nome' => 'created_at', 'tipo' => 'timestamp', 'descricao' => 'Data de criação do registro', 'is_primary_key' => false],
            ['tabela_id' => $tabelaId, 'nome' => 'updated_at', 'tipo' => 'timestamp', 'descricao' => 'Data da última atualização do registro', 'is_primary_key' => false],
        ];

        $this->inserirCampos($campos);
    }

    private function inserirCamposCstb()
    {
        $tabelaId = DB::table('tabela')->where('nome', 'cstb')->first()->id;

        $campos = [
            ['tabela_id' => $tabelaId, 'nome' => 'nr_cstb', 'tipo' => 'text', 'descricao' => '', 'is_primary_key' => true],
            ['tabela_id' => $tabelaId, 'nome' => 'ds_cstb', 'tipo' => 'text', 'descricao' => '', 'is_primary_key' => false],
            ['tabela_id' => $tabelaId, 'nome' => 'created_at', 'tipo' => 'timestamp', 'descricao' => 'Data de criação do registro', 'is_primary_key' => false],
            ['tabela_id' => $tabelaId, 'nome' => 'updated_at', 'tipo' => 'timestamp', 'descricao' => 'Data da última atualização do registro', 'is_primary_key' => false],
        ];

        $this->inserirCampos($campos);
    }

    private function inserirCamposDespesaParticipacao() {
        $tabelaId = DB::table('tabela')->where('nome', 'despesa_participacao')->first()->id;
        $campos = [
            ['tabela_id' => $tabelaId, 'nome' => 'cd_despesa_historico', 'tipo' => 'integer', 'descricao' => '', 'is_primary_key' => true],
            ['tabela_id' => $tabelaId, 'nome' => 'cd_despesa', 'tipo' => 'integer', 'descricao' => '', 'is_primary_key' => false],
            ['tabela_id' => $tabelaId, 'nome' => 'cd_unidade_operacional', 'tipo' => 'integer', 'descricao' => '', 'is_primary_key' => false],
            ['tabela_id' => $tabelaId, 'nome' => 'cd_centro_custo', 'tipo' => 'integer', 'descricao' => '', 'is_primary_key' => false],
            ['tabela_id' => $tabelaId, 'nome' => 'dt_lancamento', 'tipo' => 'date', 'descricao' => '', 'is_primary_key' => false],
            ['tabela_id' => $tabelaId, 'nome' => 'pr_lancamento', 'tipo' => 'numeric(15,2)', 'descricao' => '', 'is_primary_key' => false],
            ['tabela_id' => $tabelaId, 'nome' => 'id_validacao', 'tipo' => 'smallint', 'descricao' => '', 'is_primary_key' => false],
            ['tabela_id' => $tabelaId, 'nome' => 'cd_pessoa_usuario', 'tipo' => 'smallint', 'descricao' => '', 'is_primary_key' => false],
            ['tabela_id' => $tabelaId, 'nome' => 'created_at', 'tipo' => 'timestamp', 'descricao' => 'Data de criação do registro', 'is_primary_key' => false],
            ['tabela_id' => $tabelaId, 'nome' => 'updated_at', 'tipo' => 'timestamp', 'descricao' => 'Data da última atualização do registro', 'is_primary_key' => false],
        ];
        $this->inserirCampos($campos);
    }

    private function inserirCampos(array $campos)
    {
        foreach ($campos as $campo) {
            $existe = DB::table('campo')
                ->where('tabela_id', $campo['tabela_id'])
                ->where('nome', $campo['nome'])
                ->exists();

            if (!$existe) {
                DB::table('campo')->insert($campo);
            }
        }
    }
}

