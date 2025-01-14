<?php

namespace App\Http\Controllers;

use App\Models\Tabela;
use Illuminate\Http\Request;

class TabelaController extends Controller
{
    // Lista todas as tabelas
    public function index()
    {
        $tabelas = Tabela::with('campos')->get(); // Carrega tabelas com seus campos relacionados
        return view('tabelas.index', compact('tabelas'));
    }

    // Cria uma nova tabela
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:1000',
        ]);

        $tabela = Tabela::create($request->only('nome', 'descricao'));

        return response()->json(['success' => true, 'message' => 'Tabela criada com sucesso.', 'tabela' => $tabela]);
    }

    // Mostra uma tabela específica
    public function show($id)
    {
        $tabela = Tabela::with('campos')->findOrFail($id);
        return response()->json(['tabela' => $tabela]);
    }

    // Atualiza uma tabela
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:1000',
        ]);

        $tabela = Tabela::findOrFail($id);
        $tabela->update($request->only('nome', 'descricao'));

        return response()->json(['success' => true, 'message' => 'Tabela atualizada com sucesso.']);
    }

    // Exclui uma tabela
    public function destroy($id)
    {
        try {
            $tabela = Tabela::findOrFail($id);
            $tabela->delete();

            return response()->json(['success' => true, 'message' => 'Tabela excluída com sucesso.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Erro ao excluir tabela.'], 500);
        }
    }
}
