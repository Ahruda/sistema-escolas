@extends('templates.template')

@section('content')

        <div class="col-md-12">

            <div class="card mt-5">
                <div class="card-header">
                    <h2>Editar dados do aluno</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{url("alunos/$aluno->id")}}">
                        @method('PUT')
                        @csrf <!-- Fornece segurança ao formulário evitando ataques -->

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="{{$aluno->nome}}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="text" name="email" id="email" class="form-control" value="{{$aluno->email}}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="nome" class="form-label">Telefone</label>
                                <input type="text" name="telefone" id="telefone" class="form-control" value="{{$aluno->telefone}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="data" class="form-label">Data de nascimento</label>
                                <input type="date" name="data" id="data" class="form-control" value="{{$aluno->data_nascimento}}">
                            </div>
                            <div class="col-md-4">
                                <label for="data" class="form-label">Gênero</label>
                                <select class="form-select" name="genero" id="genero" aria-label="Gênero">
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
                        

                        
                        <button type="submit" class="btn btn-success">Editar</button>
                    </form>
                </div>
            </div>

        </div>

@endsection