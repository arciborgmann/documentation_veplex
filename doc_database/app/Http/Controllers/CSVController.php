<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Csv\Reader;
use App\Models\Tabela;
use App\Models\Campo;
use Illuminate\Support\Facades\Log;

class CSVController extends Controller
{
    public function showForm()
    {
        return view('upload'); // Exibe o formulário
    }

    public function handleUpload(Request $request)
    {
        try {
            // Validação do arquivo CSV
            $request->validate([
                'csv_file' => 'required|file|mimes:csv,txt',
            ]);

            // Move o arquivo para o diretório 'uploads'
            $path = $request->file('csv_file')->store('uploads');

            // Obtém o caminho completo do arquivo armazenado
            $filePath = storage_path('app/' . $path);

            // Tenta ler o arquivo CSV
            $csv = Reader::createFromPath($filePath, 'r');
            $csv->setHeaderOffset(0); // Define o cabeçalho no arquivo CSV
            $records = $csv->getRecords(); // Obtém os registros

            // Processamento dos dados do CSV
            $currentTable = ''; // Para acompanhar a tabela atual

            foreach ($records as $record) {
                $this->saveTabelaAndCampos($record, $currentTable);
            }

            return redirect()->back()->with('success', 'Arquivo CSV importado com sucesso.');

        } catch (\Exception $e) {
            // Loga o erro e exibe uma mensagem de erro
            Log::error('Erro ao processar o upload: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Houve um erro ao processar o arquivo CSV.');
        }
    }

    private function saveTabelaAndCampos($record, &$currentTable)
    {
        try {
            $tabelaNome = $record['Tabela']; // Nome da tabela
            //$descricaoTabela = $record['DescriçãoTabela']; //Descrição da Tabela
            $campoNome = $record['Campo']; // Nome do campo
            $campoTipo = $record['Tipo']; // Tipo do campo
            $descricao = $record['Descrição']; // Descrição do campo
            $isPrimaryKey = $record['PK'] == 'X' ? true : false; // Verifica se é chave primária

            // Verifique se o nome da tabela mudou
            if ($tabelaNome !== $currentTable) {
                // A tabela mudou, ou seja, estamos processando uma nova tabela
                $currentTable = $tabelaNome;

                // Cria ou encontra a tabela no banco de dados
                $tabela = Tabela::firstOrCreate(
                    ['nome' => $tabelaNome], // Condição de busca
                    ['descricao' => 'Descrição da Tabela'] //$descricaoTabela
                );

                // Log para verificar se a tabela foi criada ou encontrada
                Log::info("Tabela processada: {$tabelaNome}");
            } else {
                // Caso contrário, busca a tabela já criada
                $tabela = Tabela::where('nome', $currentTable)->first();
            }

            // Log para verificar se a tabela foi encontrada ou criada
            Log::info("Tabela ID: {$tabela->id} | Nome: {$tabela->nome}");

            // Verifica se o campo já existe nessa tabela
            $campoExistente = Campo::where('tabela_id', $tabela->id)
                                    ->where('nome', $campoNome)
                                    ->first();

            if ($campoExistente) {
                // Se o campo já existir, podemos atualizar (caso necessário)
                Log::info("Campo já existe, atualizando: {$campoNome}");
                $campoExistente->update([
                    'tipo' => $campoTipo,
                    'descricao' => $descricao,
                    'is_primary_key' => $isPrimaryKey,
                ]);
            } else {
                // Se o campo não existir, cria um novo
                Log::info("Campo novo, criando: {$campoNome}");
                Campo::create([
                    'tabela_id' => $tabela->id, // Relacionamento com a tabela
                    'nome' => $campoNome,
                    'tipo' => $campoTipo,
                    'descricao' => $descricao,
                    'is_primary_key' => $isPrimaryKey,
                ]);
            }
        } catch (\Exception $e) {
            // Loga o erro específico do campo e continua
            Log::error('Erro ao salvar tabela/campo: ' . $e->getMessage());
        }
    }
}