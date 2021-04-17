<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ModelTurmas;

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

    public function relTurmas()
    {
        return $this->belongsToMany(ModelTurmas::class,'aluno_turma', 'id_aluno','id_turma');
    }
}
