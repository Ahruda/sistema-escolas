@extends('templates.template')

@section('content')
    <div class="col-md-12">

        <div class="card mt-3">
            <div class="card-header">
                <h2>Alunos</h2>
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="turma" class="col-form-label">Exibindo</label>
                    </div>
                    <div class="col-auto">
                        <select class="form-select" id="turma">
                            <option value="0">Todos os alunos cadastrados</option>
                            @foreach($turmas as $turma)
                                <option value="{{$turma->id}}">
                                    ({{$turma->ano}})
                                    {{$turma->serie}} - 
                                    @if($turma->turno == 1)
                                        Manhã
                                    @elseif($turma->turno == 2)
                                        Tarde
                                    @elseif($turma->turno == 3)
                                        Noite
                                    @endif
                                    <br> -
                                    @if($turma->nivel == 1)
                                        Fundamental
                                    @elseif($turma->nivel == 2)
                                        Médio
                                    @elseif($turma->nivel == 3)
                                        Superior
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>   
            </div>
            <div class="card-body">
                <a href="{{url('alunos/create')}}" class="btn btn-success mb-3 end">+ Novo Aluno</a>
                <div id="table_id">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmacaoModal" tabindex="-1" aria-hidden="true">
        <form method="post" id="formDelete">
            @method('delete')
            @csrf <!-- Fornece segurança ao formulário evitando ataques --> 
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Tem certeza que deseja excluir?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>
                            O seguinte registro será apagado:
                        </p>
                        <strong>ID:</strong> <span id="idModal"></span> <br>
                        <strong>Aluno:</strong> <span id="nomeModal"></span>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                    </div>
                </div>
            </div>
        </form>

        
    </div>
    <script type="text/javascript">

        $(document).ready( function () {
            myScript();
        } );

        /*
            Exibe o modal de confirmação para a exclusão com algumas Informações
            e o seu action com o id do registro que deverá ser excluido
        */
        function modalDelete(aluno){
            document.getElementById("idModal").innerHTML = aluno.id; 
            document.getElementById("nomeModal").innerHTML = aluno.nome; 
            document.getElementById("formDelete").action = "alunos/"+aluno.id;
            $('#confirmacaoModal').modal('show');
        }

        let turma = document.getElementById("turma");

        turma.addEventListener("change", myScript);

        /*
            myScript irá mandar carregar na div table_id a tabela dos alunos
            que estão na turma definida pelo filtro
        */
        function myScript(){
            $('#table_id').load('/alunos/'+turma.value);
        }

    </script>

    @endsection

