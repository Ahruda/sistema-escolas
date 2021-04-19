<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turmas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_escola')->unsigned();
            $table->foreign('id_escola')->references('id')->on('escolas')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('ano');
            $table->integer('nivel');
            $table->string('serie'); 
            $table->integer('turno');
            $table->timestamps();   
            /*
                Métodos onDelete e onUpdate cascade define que, caso a escola em que a turma
                pertence seja excluida ou seu id seja alterado, a turma também será excluida ou o 
                id_escola seja atualizado para manter a relação 
            */

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_turmas');
    }
}
