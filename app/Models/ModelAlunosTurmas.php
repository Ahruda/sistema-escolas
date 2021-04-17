<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelAlunosTurmas extends Model
{
    protected $table = 'aluno_turma';

    protected $fillable = [
        'id_aluno',
        'id_turma'
    ];

}