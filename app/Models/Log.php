<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    // Se sua tabela não seguir o plural padrão 'logs', defina explicitamente o nome da tabela:
    // protected $table = 'nome_da_tabela';

    // Campos que podem ser preenchidos via mass assignment
    protected $fillable = [
        'message',
        'level',
        'context',
        'created_at',
        'updated_at',
    ];

    // Se desejar, pode definir timestamps manualmente
    public $timestamps = true;
}
