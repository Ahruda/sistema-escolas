@extends('templates.template')

@section('content')
    <div class="col-md-12">

        <div class="card mt-3">
            <div class="card-header">
                <h2>Escolas</h2>
            </div>
            <div class="card-body">

                <a href="{{url('escolas/create')}}" class="btn btn-success mb-3 end">+ Nova Escola</a>

                <table class="table text-center" id="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Endereço</th>
                            <th scope="col">Quantidade de Alunos</th>
                            <th scope="col">Data de Inserção</th>
                            <th scope="col">Situação</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($escolas as $escola)
                            <tr>
                                <td>{{$escola->id}}</td>
                                <td>{{$escola->nome}}</td>
                                <td>{{$escola->endereco ?? "Não informado"}}</td>
                                <td>
                                    @foreach($alunosEscolasCol as $alunosEscolaColl)
                                        @if($alunosEscolaColl['id_escola'] == $escola->id)
                                            {{$alunosEscolaColl['quantidade']}} Alunos
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{Carbon\Carbon::parse($escola->data_insercao)->format('d/m/Y')}}</td>
                                <td>
                                    @if($escola->situacao == 1)
                                        Ativa
                                    @else
                                        Inativa
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url("escolas/$escola->id/edit")}}" style="text-decoration:none">
                                        <button class="btn btn-warning" style="margin-right:5px"><i class="fas fa-pencil-alt"></i>Editar</button>
                                    </a>

                                    <button onclick="modalDelete({{$escola}})" class="btn btn-danger">Excluir</button>
                                   
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
                        <strong>Escola:</strong> <span id="nomeModal"></span>
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

        function modalDelete(escola){
            document.getElementById("idModal").innerHTML = escola.id; 
            document.getElementById("nomeModal").innerHTML = escola.nome; 
            document.getElementById("formDelete").action = "escolas/"+escola.id;
            $('#confirmacaoModal').modal('show');
        }
    </script>

    @endsection

