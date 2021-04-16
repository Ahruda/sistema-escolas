<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelEscolas;

class EscolasController extends Controller
{

    private $objEscola;

    public function __construct()
    {
        $this->objEscola = new ModelEscolas();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $escolas = $this->objEscola->all();
        return view('escolas/index',compact('escolas'));
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
