<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabela extends Model
{
    use HasFactory;

    protected $table = 'tabela';

    // Permitir atribuição em massa para esses campos
    protected $fillable = ['nome', 'descricao'];

    // Relacionamento com os campos
    public function campos()
    {
        return $this->hasMany(Campo::class);
    }
}