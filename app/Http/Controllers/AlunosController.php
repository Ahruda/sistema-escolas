<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelAlunos;
use App\Models\ModelTurmas;
use App\Models\ModelEscolas;

class AlunosController extends Controller
{

    private $objAluno;
    private $objTurma;
    private $objEscola;


    public function __construct()
    {
        $this->objAluno = new ModelAlunos();
        $this->objTurma = new ModelTurmas();
        $this->objEscola = new ModelEscolas();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = $this->objAluno->all();
        return view('alunos/index',compact('alunos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $escolas = $this->objEscola->all();
        //$turmas = $this->objTurma->where('id_escola', $id)->get();
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
    public function show($id)
    {

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
        return view('alunos/editar',compact('aluno'));
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
        $up=$this->objAluno->where(['id' => $id])->update([
            'nome'=>$request->nome,
            'email'=>$request->email,
            'telefone'=>$request->telefone,
            'data_nascimento'=>$request->data,
            'genero'=>$request->genero
        ]);
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
