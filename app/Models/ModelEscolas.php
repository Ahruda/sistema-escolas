<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelEscolas extends Model
{
    protected $table = 'escolas';

    protected $fillable = [
        'nome',
        'endereco',
        'situacao',
        'data_insercao'
    ];

    public function relTurmas()
    {
        //relacionamento Escola -> turmas; Uma escola pode ter várias turmas
        return $this->hasMany('App\Models\ModelTurmas','id_escola');
        //('model de referência','chave estrangeira')

    }

}

