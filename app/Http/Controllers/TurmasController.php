<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelTurmas;
use App\Models\ModelEscolas;

class TurmasController extends Controller
{
    
    private $objTurma;
    private $objEscola;

    public function __construct()
    {
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
        $up=$this->objTurma->where(['id' => $id])->update([
            'ano'=>$request->ano,
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
        $des=$this->objTurma->destroy($id);
        if($des){
            return redirect('turma')->with('success','Turma excluido com sucesso!');
        }else{
            return redirect('turma')->with('warning ','Ocorreu um erro, tente novamente!');
        }
    }
}
