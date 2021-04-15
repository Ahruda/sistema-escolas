<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelAlunos extends Model
{
    protected $table = 'alunos';

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'data_nascimento',
        'genero'
    ];
}
