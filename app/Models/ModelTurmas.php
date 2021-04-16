<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelTurmas extends Model
{
    protected $table = 'turmas';

    protected $fillable = [
        'ano',
        'nivel',
        'serie',
        'turno'
    ];
}
