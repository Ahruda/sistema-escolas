<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelAlunos;
use App\Models\ModelTurmas;
use App\Models\ModelEscolas;
use App\Models\ModelAlunosTurmas;

class EscolasController extends Controller
{

    private $objAluno;
    private $objTurma;
    private $objEscola;
    private $objalunoTurmas;
    private $alunosEscola;

    public function __construct()
    {
        $this->objAluno = new ModelAlunos();
        $this->objTurma = new ModelTurmas();
        $this->objEscola = new ModelEscolas();
        $this->objalunoTurmas = new ModelAlunosTurmas();
        //$this->alunosEscola = new Coletion
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $escolas = $this->objEscola->all();
        $alunosEscolasCol=collect();

        foreach ($escolas as $escola){
            $query = $this->objAluno
            ->select('alunos.id as quantidadeAlunos')
            ->join('aluno_turma', 'alunos.id', '=', 'aluno_turma.id_aluno')
            ->join('turmas', 'aluno_turma.id_turma', '=', 'turmas.id')
            ->join('escolas', 'turmas.id_escola', '=', 'escolas.id')
            ->where('escolas.id', '=', $escola->id)
            ->distinct()
            ->get()
            ->count();
            $alunosEscolasCol->push(["id_escola" => $escola->id, "quantidade" => $query]); 
        }

        return view('escolas/index',compact('escolas','alunosEscolasCol'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('escolas/cadastrar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cad=$this->objEscola->create([
            'nome'=>$request->nome,
            'endereco'=>$request->endereco,
            'situacao'=>$request->situacao,
            'data_insercao'=>$request->data_insercao
        ]);
        if($cad){
            return redirect('escolas')->with('success','Escola cadastrada com sucesso!');;
        }else{
            return redirect('escolas')->with('warning ','Ocorreu um erro, tente novamente!');
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
        $escola = $this->objEscola->find($id);
        return view('escolas/editar',compact('escola'));
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
        $up=$this->objEscola->where(['id' => $id])->update([
            'nome'=>$request->nome,
            'endereco'=>$request->endereco,
            'situacao'=>$request->situacao,
            'data_insercao'=>$request->data_insercao
        ]);
        if($up){
            return redirect('escolas')->with('success','Informações editadas com sucesso!');
        }else{
            return redirect('escolas')->with('warning ','Ocorreu um erro, tente novamente!');
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
        $des=$this->objEscola->destroy($id);
        if($des){
            return redirect('escolas')->with('success','Escola excluida com sucesso!');
        }else{
            return redirect('escolas')->with('warning ','Ocorreu um erro, tente novamente!');
        }
    }
}
