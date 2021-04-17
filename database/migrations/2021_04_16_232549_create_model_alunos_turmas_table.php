<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelAlunosTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aluno_turma', function (Blueprint $table) {
            $table->integer('id_aluno')->unsigned();
            $table->integer('id_turma')->unsigned();
            $table->foreign('id_aluno')->references('id')->on('alunos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_turma')->references('id')->on('turmas')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aluno_turma');
    }
}
