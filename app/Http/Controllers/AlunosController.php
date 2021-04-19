<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelAlunos;
use App\Models\ModelTurmas;
use App\Models\ModelEscolas;
use App\Models\ModelAlunosTurmas;

class AlunosController extends Controller
{
    //Instância os objetos que farão a conexão com o banco
    private $objAluno;
    private $objTurma;
    private $objEscola;
    private $objalunoTurmas;


    public function __construct()
    {
        //Inicializa os objetos
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
        /*
        Obtem todos os registros do banco de dados e envia 
        para a view index para visualização
         */
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
        /*
        Obtem os dados via request e salva no banco de dados
        */
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
        /*
        Envia para a view tabela a relação de alunos em uma 
        turma especifica através do parametro recebido
        */
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
        /*
        Obtem o aluno especificado
        pelo id que veio como parâmetro da rota
        e obtem todos os registros de escolas e turmas
        */
        $aluno = $this->objAluno->find($id);
        $escolas = $this->objEscola->all();
        $turmas = $this->objTurma->all();
        $alunoTurmas = $this->objalunoTurmas->where('id_aluno', $id)->get('id_turma');
        return view('alunos/editar',compact('aluno','escolas','turmas','alunoTurmas'));
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
        $aluno = $this->objAluno->find($id);
        
        $up = $aluno->update([
            'nome'=>$request->nome,
            'email'=>$request->email,
            'telefone'=>$request->telefone,
            'data_nascimento'=>$request->data,
            'genero'=>$request->genero
        ]);

        // Sincroniza a tabela de relação Alunos-Turmas com as novas alterações
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
        /*
        Através do paramentro recebido pela rota
        ele exclui o registro de mesmo id no banco de dados
        */
        $des=$this->objAluno->destroy($id);
        if($des){
            return redirect('alunos')->with('success','Aluno excluido com sucesso!');
        }else{
            return redirect('alunos')->with('warning ','Ocorreu um erro, tente novamente!');
        }
    }
}
