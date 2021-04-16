<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelAlunos;

class AlunosController extends Controller
{

    private $objAluno;

    public function __construct()
    {
        $this->objAluno = new ModelAlunos();
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
        return view('alunos/cadastrar');
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
        //
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
