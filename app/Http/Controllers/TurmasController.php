<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelTurmas;
use App\Models\ModelEscolas;

class TurmasController extends Controller
{
    //Instância os objetos que farão a conexão com o banco
    private $objTurma;
    private $objEscola;

    public function __construct()
    {
        //Inicializa os objetos
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
        /*      
        Para a visualização na tabela, cria-se as 
        coleções de turmas e escolas que possuem
        todos os registros do banco de dados e envia
        para a view index
        */        
        $turmas = $this->objTurma->all();
        $escolas = $this->objEscola->all();
        return view('turmas/index',compact('turmas','escolas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
        Obtem todas as escolas e manda para 
        view cadastrar para que o usuario possa definir 
        uma escola para a nova turma
        */
        $escolas=$this->objEscola->all();
        return view('turmas/cadastrar',compact('escolas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        Obtem os dados via request e salva no banco de dados
        */
        $cad=$this->objTurma->create([
            'ano'=>$request->ano,
            'id_escola'=>$request->escola,
            'nivel'=>$request->nivel,
            'serie'=>$request->serie,
            'turno'=>$request->turno
        ]);
        if($cad){
            return redirect('turmas')->with('success','Turma cadastrada com sucesso!');
        }else{
            return redirect('turmas')->with('warning ','Ocorreu um erro, tente novamente!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*
        Obtem todas as escolas e a turma especificada
        pelo id que veio como parâmetro da rota
        */
        $turma = $this->objTurma->find($id);
        $escolas = $this->objEscola->all();
        return view('turmas/editar',compact('turma','escolas'));
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
        /*
        Obtem os dados via request e salva no banco de dados
        */
        $up=$this->objTurma->where(['id' => $id])->update([
            'ano'=>$request->ano,
            'id_escola'=>$request->escola,
            'nivel'=>$request->nivel,
            'serie'=>$request->serie,
            'turno'=>$request->turno
        ]);
        if($up){
            return redirect('turmas')->with('success','Informações editadas com sucesso!');
        }else{
            return redirect('turmas')->with('warning ','Ocorreu um erro, tente novamente!');
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
        /*
        Através do paramentro recebido pela rota
        ele exclui o registro de mesmo id no banco de dados
        */
        $des=$this->objTurma->destroy($id);
        if($des){
            return redirect('turmas')->with('success','Turma excluido com sucesso!');
        }else{
            return redirect('turmas')->with('warning ','Ocorreu um erro, tente novamente!');
        }
    }
}
