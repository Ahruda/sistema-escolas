@extends('templates.template')

@section('content')
    <div class="col-md-12">

        <div class="card mt-3">
            <div class="card-header">
                <h2>Turmas</h2>
            </div>
            <div class="card-body">

                <a href="{{url('turmas/create')}}" class="btn btn-success mb-3 end">+ Nova Turma</a>

                <table class="table" id="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Ano</th>
                            <th scope="col">Nivel</th>
                            <th scope="col">Série</th>
                            <th scope="col">Turno</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($turmas as $turma)
                            <tr>
                                <td>{{$turma->id}}</td>
                                <td>{{$turma->ano}}</td>
                                <td>
                                    @if($turma->nivel == 1)
                                        Fundamental
                                    @elseif($turma->nivel == 2)
                                        Médio
                                    @elseif($turma->nivel == 3)
                                        Superior
                                    @endif
                                </td>
                                <td>{{$turma->serie}}ª Série</td>
                                <td>
                                    @if($turma->turno == 1)
                                        Manhã
                                    @elseif($turma->turno == 2)
                                        Tarde
                                    @elseif($turma->turno == 3)
                                        Noite
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url("turmas/$turma->id/edit")}}" style="text-decoration:none">
                                        <button class="btn btn-warning" style="margin-right:5px">Editar</button>
                                    </a>

                                    <button onclick="modalDelete({{$turma}})" class="btn btn-danger">Excluir</button>                                  
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

        function modalDelete(turma){
            document.getElementById("idModal").innerHTML = turma.id; 
            document.getElementById("nomeModal").innerHTML = turma.nome; 
            document.getElementById("formDelete").action = "turmas/"+turma.id;
            $('#confirmacaoModal').modal('show');
        }
    </script>

    @endsection

