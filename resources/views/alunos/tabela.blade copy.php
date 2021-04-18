@extends('templates.template')

@section('content')
    <div class="col-md-12">

        <div class="card mt-3">
            <div class="card-header">
                <h2>Alunos</h2>
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                    <label for="escola" class="col-form-label">Exibindo turmas de</label>
                    </div>
                    <div class="col-auto" id="filtro">
                    </div>
                </div>   
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
                            @if( $IdRelacionamentoAlunos->contains('id_aluno',$aluno->id) )
                            <tr>
                                <td>{{$aluno->id}}</td>
                                <td>{{$aluno->nome}}</td>
                                <td>{{$aluno->telefone}}</td>
                                <td>{{$aluno->email}}</td>
                                <td>{{Carbon\Carbon::parse($aluno->data_nascimento)->format('d/m/Y')}}</td>
                                <td>
                                    @if($aluno->genero == 1)
                                        Masculino
                                    @else
                                        Feminino
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url("alunos/$aluno->id/edit")}}" style="text-decoration:none">
                                        <button class="btn btn-warning" style="margin-right:5px">Editar</button>
                                    </a>
                                    <button onclick="modalDelete({{$aluno}})" class="btn btn-danger">Excluir</button>                                   
                                </td>
                            </tr>
                            @else
                            @endif
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
    <div id="tabelaNova"></div>
    <script type="text/javascript">

        $(document).ready( function () {
            $('#table').DataTable({
                "language": {
                    "url": "assets/dataTables/ptbr.json"
                },
                initComplete: function () {
                    this.api().columns([5]).every( function () {
                        var column = this;
                        var select = $('<select class="form-select"><option value="">Todas asTurmas</option></select>')
                            .appendTo( '#filtro' )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
        
                                column
                                    .search( val ? '^'+val+'$' : '', true, false )
                                    .draw();
                            } );
        
                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                    } );
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

