<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campo extends Model
{
    use HasFactory;

    protected $table = 'campo'; // Nome da tabela de campos

    // Permitir atribuição em massa para esses campos
    protected $fillable = ['tabela_id', 'nome', 'tipo', 'descricao', 'is_primary_key'];

    // Relacionamento inverso com a tabela
    public function tabela()
    {
        return $this->belongsTo(Tabela::class);
    }
}
