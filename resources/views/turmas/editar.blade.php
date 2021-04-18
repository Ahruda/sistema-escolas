@extends('templates.template')

@section('content')

        <div class="col-md-12">

            <div class="card mt-3">
                <div class="card-header">
                    <h2>Editar dados da turma</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{url("turmas/$turma->id")}}">
                        @method('PUT')
                        @csrf <!-- Fornece segurança ao formulário evitando ataques -->

                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="ano" class="form-label">Ano</label>
                                <input type="number" name="ano" id="ano" class="form-control" value="{{$turma->ano}}" required>
                                <small class="form-text text-muted">Ex.: 2020, 2021, 2022...</small>
                            </div>
                            <div class="col-md-2">
                                <label for="serie" class="form-label">Série</label>
                                <input type="text" name="serie" id="serie" class="form-control" value="{{$turma->serie}}" required>
                                <small class="form-text text-muted">Ex.: 7ª Série A, 8ª Série B...</small>
                            </div>
                            <div class="col-md-5">
                                <label for="nivel" class="form-label">Nivel de ensino</label>
                                <select class="form-select" name="nivel" id="nivel">
                                    @if( ($turma->nivel) == 1 )
                                        <option value="1" selected>Fundamental</option>
                                        <option value="2">Médio</option>
                                        <option value="3">Superior</option>
                                    @elseif ( ($turma->nivel) == 2 )
                                        <option value="1">Fundamental</option>
                                        <option value="2" selected>Médio</option>
                                        <option value="3">Superior</option>
                                    @elseif ( ($turma->nivel) == 3 )
                                        <option value="1">Fundamental</option>
                                        <option value="2">Médio</option>
                                        <option value="3"selected>Superior</option>
                                    @endif
                                </select>                                 
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="turno" class="form-label">Turno</label>
                                <select class="form-select" name="turno" id="turno">
                                    @if( ($turma->turno) == 1 )
                                        <option value="1" selected>Manhã</option>
                                        <option value="2">Tarde</option>
                                        <option value="3">Noite</option>
                                    @elseif ( ($turma->turno) == 2 )
                                        <option value="1">Manhã</option>
                                        <option value="2" selected>Tarde</option>
                                        <option value="3">Noite</option>
                                    @elseif ( ($turma->turno) == 3 )
                                        <option value="1">Manhã</option>
                                        <option value="2">Tarde</option>
                                        <option value="3"selected>Noite</option>
                                    @endif
                                </select>                            
                            </div>
                            <div class="col-md-4">
                                <label for="escola" class="form-label">Escola</label>
                                <select class="form-select" name="escola" id="escola">
                                        <option value="{{$turma->relEscolas->id}}">{{$turma->relEscolas->nome}}</option>
                                    @foreach($escolas as $escola)
                                        @if($escola->id != $turma->relEscolas->id)
                                            <option value="{{$escola->id}}">{{$escola->nome}}</option>
                                        @endif
                                    @endforeach
                                </select>                            
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-success">Editar</button>
                    </form>
                </div>
            </div>

        </div>

@endsection