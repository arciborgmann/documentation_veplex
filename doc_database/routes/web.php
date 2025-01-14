<?php

use App\Http\Controllers\CampoController;
use App\Http\Controllers\CSVController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentacaoController;
use App\Http\Controllers\TabelaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/csrf-token', function () {
    return csrf_token();
});

Route::get('/documentacao', [DocumentacaoController::class, 'index'])->name('documentacao');

Route::get('upload', [CSVController::class, 'showForm']); // Exibe o formulário
Route::post('upload', [CSVController::class, 'handleUpload']); // Processa o upload
Route::delete('/tabelas/{id}', [TabelaController::class, 'destroy'])->name('tabelas.destroy');
Route::delete('/campos/{id}', [CampoController::class, 'destroy'])->name('campos.destroy');





