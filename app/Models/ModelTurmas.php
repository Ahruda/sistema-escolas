<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelTurmas extends Model
{
    protected $table = 'turmas';

    protected $fillable = [
        'ano',
        'id_escola',
        'nivel',
        'serie',
        'turno'
    ];

    public function relEscolas()
    {
        //relacionamento turmas -> escola; Uma turma pode ter apenas uma escola
        return $this->hasOne('App\Models\ModelEscolas','id','id_escola');
        //('model de referência','chave estrangeira','chave local')
    }

}
