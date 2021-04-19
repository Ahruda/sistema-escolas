<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelAlunos;
use App\Models\ModelEscolas;

class EscolasController extends Controller
{
    //Instância os objetos que farão a conexão com o banco
    private $objAluno;
    private $objEscola;

    public function __construct()
    {
        //Inicializa os objetos
        $this->objAluno = new ModelAlunos();
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
        Para a visualização na tabela, cria-se a 
        coleção de escolas que possue e envia
        todos os registros do banco de dados 
        para a view index
        */
        /*      
        Cria-se a coleção alunosEscolasCol, que vai
        relacionar o id da escola com a quantidade de
        alunos
        */         
        $escolas = $this->objEscola->all();
        $alunosEscolasCol=collect();
        /*      
        O query executado efetua o Join para obter a quantidade
        de alunos de cada escola e salva na coleção, relacionando
        o id da escola com a quantidade de alunos
        */         
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
            //Insere na coleção o id da escola e a quantidade de alunos
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
        /*
        Obtem os dados via request e salva no banco de dados
        */
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*
        Obtem a escola especificada
        pelo id que veio como parâmetro da rota
        */
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
        /*
        Obtem os dados via request e salva no banco de dados
        */
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
        /*
        Através do paramentro recebido pela rota
        ele exclui o registro de mesmo id no banco de dados
        */
        $des=$this->objEscola->destroy($id);
        if($des){
            return redirect('escolas')->with('success','Escola excluida com sucesso!');
        }else{
            return redirect('escolas')->with('warning ','Ocorreu um erro, tente novamente!');
        }
    }
}
