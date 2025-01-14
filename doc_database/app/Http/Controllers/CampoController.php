<?php

namespace App\Http\Controllers;

use App\Models\Campo;
use App\Models\Tabela;
use Illuminate\Http\Request;

class CampoController extends Controller
{
    // Cria um novo campo para uma tabela
    public function store(Request $request, $tabelaId)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:1000',
            'is_primary_key' => 'boolean',
        ]);

        $tabela = Tabela::findOrFail($tabelaId);

        $campo = $tabela->campos()->create([
            'nome' => $request->input('nome'),
            'tipo' => $request->input('tipo'),
            'descricao' => $request->input('descricao'),
            'is_primary_key' => $request->boolean('is_primary_key'),
        ]);

        return response()->json(['success' => true, 'message' => 'Campo adicionado com sucesso.', 'campo' => $campo]);
    }

    // Atualiza um campo existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:1000',
            'is_primary_key' => 'boolean',
        ]);

        $campo = Campo::findOrFail($id);
        $campo->update($request->all());

        return response()->json(['success' => true, 'message' => 'Campo atualizado com sucesso.']);
    }

    // Exclui um campo
    public function destroy($id)
    {
        try {
            $campo = Campo::findOrFail($id);
            $campo->delete();

            return response()->json(['success' => true, 'message' => 'Campo excluído com sucesso.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Erro ao excluir campo.'], 500);
        }
    }
}
