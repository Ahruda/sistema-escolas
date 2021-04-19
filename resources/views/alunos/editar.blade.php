@extends('templates.template')

@section('content')

        <div class="col-md-12">

            <div class="card mt-5">
                <div class="card-header">
                    <h2>Editar dados do alunos</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{url("alunos/$aluno->id")}}">
                        @method('PUT') <!-- Pela documentação, o formulado de edição deve ser do método put -->
                        @csrf <!-- Fornece segurança ao formulário evitando ataques -->

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="{{$aluno->nome}}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{$aluno->email}}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="nome" class="form-label">Telefone</label>
                                <input type="text" name="telefone" id="telefone" value="{{$aluno->telefone}}" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="data" class="form-label">Data de nascimento</label>
                                <input type="date" name="data" id="data" class="form-control" value="{{$aluno->data_nascimento}}">
                            </div>
                            <div class="col-md-4">
                                <label for="genero" class="form-label">Gênero</label>
                                <select class="form-select" name="genero" id="genero">
                                    @if( ($aluno->genero) == 1 )
                                        <option value="1" selected>Masculino</option>
                                        <option value="2">Feminino</option>
                                    @else
                                        <option value="1">Masculino</option>
                                        <option value="2" selected>Feminino</option>
                                    @endif
                                </select>                            
                            </div>
                            
                        </div>

                        <div class="row g-3 mt-4 mb-4">
                            <div class="col-auto">
                              <h3>Selecione as turmas</h3>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" name="escola" id="escola">
                                    
                                    @if($alunoTurmas->isEmpty())
                                        @foreach($escolas as $escola)
                                            <option value="{{$escola->id}}">{{$escola->nome}}</option>
                                        @endforeach
                                    @else
                                        @php 
                                            $idEscola = ($turmas->find($alunoTurmas->first()->id_turma)->id_escola) 
                                        @endphp

                                        <option value="{{$idEscola}}">{{$escolas->find($idEscola)->nome}}</option>
                                        @foreach($escolas as $escola)
                                            @if($escola->id != $idEscola)
                                                <option value="{{$escola->id}}">{{$escola->nome}}</option>
                                            @endif
                                        @endforeach
                                    @endif

                                </select>                              
                            </div>
                        </div>
                            
                        <div class="row">
                            <div class="col-md-12">
                                @foreach($turmas as $turma)
                                    <input type="checkbox" class="btn-check escola{{$turma->id_escola}}" name="turmas[]" id="btncheck{{$turma->id}}" value="{{$turma->id}}" autocomplete="off" {{$alunoTurmas->contains('id_turma',$turma->id) ? 'checked' : ''}}>
                                    <label class="btn btn-outline-primary mb-1 escola{{$turma->id_escola}}" name="turmaLabel" for="btncheck{{$turma->id}}">
                                        ({{$turma->ano}})
                                        {{$turma->serie}} - 
                                        @if($turma->turno == 1)
                                            Manhã
                                        @elseif($turma->turno == 2)
                                            Tarde
                                        @elseif($turma->turno == 3)
                                            Noite
                                        @endif
                                        <br> 
                                        @if($turma->nivel == 1)
                                            Fundamental
                                        @elseif($turma->nivel == 2)
                                            Médio
                                        @elseif($turma->nivel == 3)
                                            Superior
                                        @endif
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">Concluir Alterações</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>

        <script type="text/javascript">
            var escola = document.getElementById("escola");
            var checkTurmas = document.getElementsByName('turmas');

            $(document).ready(function() {

                /*
                    Quando a página é aberta o script obtem o id da escola
                    selecionada (caso o aluno já estiver cadastrado em alguma turma)
                    e oculta todas as turmas que não são da escola em que o aluno está
                */
                $('input[class~="btn-check"]').addClass("d-none");
                $('label[class~="btn-outline-primary"]').addClass("d-none");

                $('input[class~="escola'+escola.value+'"]').removeClass("d-none");
                $('label[class~="escola'+escola.value+'"]').removeClass("d-none");
            });

            escola.addEventListener("change", myScript);

            /* 
                MyScript vai ser invocado sempre que o select escola mudar,
                o script irá ocultar as turmas que não fazem parte da escolas
                deixando apenas as que fazem parte da escola selecionada,
                quando ocorre a mudança de escola ela desmarca todas as turmas
                anteriormente selecionadas para evitar o cadastro do aluno em turmas
                de escolas diferentes
            */

            function myScript(){
                
                $('input[class~="btn-check"]').addClass("d-none").prop('checked', false);
                $('label[class~="btn-outline-primary"]').addClass("d-none");

                $('input[class~="escola'+escola.value+'"]').removeClass("d-none");
                $('label[class~="escola'+escola.value+'"]').removeClass("d-none");
                
            }
            

        </script>

@endsection