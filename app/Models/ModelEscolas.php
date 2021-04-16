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
}