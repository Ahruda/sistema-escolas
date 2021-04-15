@extends('templates.template')

@section('content')
    <div class="col-md-12">

        <div class="card mt-5">
            <div class="card-header">
                <h2>Alunos</h2>
            </div>
            <div class="card-body">

                <a href="{{url('alunos/create')}}" class="btn btn-success mb-3 end">+ Novo Aluno</a>

                <table class="table" id="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Nascimento</th>
                            <th scope="col">Gênero</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alunos as $aluno)
                            <tr>
                                <td>{{$aluno->id}}</td>
                                <td>{{$aluno->nome}}</td>
                                <td>{{$aluno->telefone}}</td>
                                <td>{{$aluno->email}}</td>
                                <td>{{$aluno->data_nascimento}}</td>
                                <td>{{$aluno->genero}}</td>
                                <td>
                                    <a href="{{url("alunos/$aluno->id/edit")}}" style="text-decoration:none">
                                        <button class="btn btn-warning" style="margin-right:5px">Editar</button>
                                    </a>

                                    <button onclick="modalDelete({{$aluno}})" class="btn btn-danger">Excluir</button>
                                   
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

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
            $('#table').DataTable({
                "language": {
                    "url": "assets/dataTables/ptbr.json"
                }
            });
        } );

        function modalDelete(aluno){
            document.getElementById("idModal").innerHTML = aluno.id; 
            document.getElementById("nomeModal").innerHTML = aluno.nome; 
            document.getElementById("formDelete").action = "alunos/"+aluno.id;
            $('#confirmacaoModal').modal('show');
        }
    </script>

    @endsection

