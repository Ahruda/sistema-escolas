<!--
    Se id_turma = 0 então a tabela deverá mostrar todos
    os alunos cadastrados, pois não foi selecionado nenhuma 
    turma especifica no filtro
-->
@if($id_turma == 0)
    <table class="table text-center" id="table">
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
        <tbody id="tbody">
            @foreach($alunos as $aluno)
                <tr>
                    <td>{{$aluno->id}}</td>
                    <td>{{$aluno->nome}}</td>
                    <td>{{ ($aluno->telefone ?? 'Não informado')}}</td>
                    <td>{{$aluno->email}}</td>
                    <td>{{ ($aluno->data_nascimento != null) ? Carbon\Carbon::parse($aluno->data_nascimento)->format('d/m/Y') : "Não informado" }}</td>
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
            @endforeach
        </tbody>
    </table>
@else
<!--
    Se id_turma != 0 então a tabela deverá mostrar todos
    os alunos cadastrados na turma selecionada no filtro
-->
    <table class="table text-center" id="table">
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
        <tbody id="tbody">
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
                @endif
            @endforeach
        </tbody>
    </table>
@endif

<script type="text/javascript">

    $(document).ready( function () {
        $('#table').DataTable({
            "language": {
                "url": "assets/dataTables/ptbr.json"
            }
        });
    } );

</script>
