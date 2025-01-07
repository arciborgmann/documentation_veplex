<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tabela;
use App\Models\Campo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DocumentacaoController extends Controller
{
    public function index()
    {
        // Buscar todas as tabelas
        $tabelas = Tabela::with('campos')->get(); // Usando relacionamento com os campos

        // Retornar para a view com os dados
        return view('documentacao', compact('tabelas'));
    }
}
