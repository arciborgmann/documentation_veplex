<?php

use App\Http\Controllers\CSVController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentacaoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/documentacao', [DocumentacaoController::class, 'index'])->name('documentacao');

Route::get('upload', [CSVController::class, 'showForm']); // Exibe o formulário
Route::post('upload', [CSVController::class, 'handleUpload']); // Processa o upload
