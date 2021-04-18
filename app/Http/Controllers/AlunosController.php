<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelAlunos;
use App\Models\ModelTurmas;
use App\Models\ModelEscolas;
use App\Models\ModelAlunosTurmas;

class AlunosController extends Controller
{

    private $objAluno;
    private $objTurma;
    private $objEscola;
    private $objalunoTurmas;


    public function __construct()
    {
        $this->objAluno = new ModelAlunos();
        $this->objTurma = new ModelTurmas();
        $this->objEscola = new ModelEscolas();
        $this->objalunoTurmas = new ModelAlunosTurmas();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = $this->objAluno->all();
        $escolas = $this->objEscola->all();
        $turmas = $this->objTurma->all();
        $alunoTurmas = $this->objalunoTurmas->all();
        return view('alunos/index',compact('alunos','escolas','turmas','alunoTurmas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $escolas = $this->objEscola->all();
        $turmas = $this->objTurma->all();
        return view('alunos/cadastrar',compact('escolas','turmas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cad=$this->objAluno->create([
            'nome'=>$request->nome,
            'email'=>$request->email,
            'telefone'=>$request->telefone,
            'data_nascimento'=>$request->data,
            'genero'=>$request->genero
        ]);
        $cad->relTurmas()->sync($request->turmas);
        if($cad){
            return redirect('alunos')->with('success','Aluno cadastrado com sucesso!');
        }else{
            return redirect('alunos')->with('warning ','Ocorreu um erro, tente novamente!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_turma)
    {
        $alunos = $this->objAluno->all();
        $IdRelacionamentoAlunos = $this->objalunoTurmas->where('id_turma', $id_turma)->get('id_aluno');
        return view('alunos/tabela',compact('alunos','IdRelacionamentoAlunos','id_turma'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aluno = $this->objAluno->find($id);
        $escolas = $this->objEscola->all();
        $turmas = $this->objTurma->all();
        $alunoTurmas = $this->objalunoTurmas->where('id_aluno', $id)->get('id_turma');
        return view('alunos/editar',compact('aluno','escolas','turmas','alunoTurmas'));
        //$primeiraTurma = $turmas->firstWhere('id_escola', '=', 1);
        
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $aluno = $this->objAluno->find($id);

        $up = $aluno->update([
            'nome'=>$request->nome,
            'email'=>$request->email,
            'telefone'=>$request->telefone,
            'data_nascimento'=>$request->data,
            'genero'=>$request->genero
        ]);
        $up = $aluno->relTurmas()->sync($request->turmas);
        
        if($up){
            return redirect('alunos')->with('success','Informações editadas com sucesso!');
        }else{
            return redirect('alunos')->with('warning ','Ocorreu um erro, tente novamente!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $des=$this->objAluno->destroy($id);
        if($des){
            return redirect('alunos')->with('success','Aluno excluido com sucesso!');
        }else{
            return redirect('alunos')->with('warning ','Ocorreu um erro, tente novamente!');
        }
    }
}
