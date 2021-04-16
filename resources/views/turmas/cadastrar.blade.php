@extends('templates.template')

@section('content')

        <div class="col-md-12">

            <div class="card mt-5">
                <div class="card-header">
                    <h2>Cadastro de Turmas</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{url('turmas')}}">

                        @csrf <!-- Fornece segurança ao formulário evitando ataques -->

                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="ano" class="form-label">Ano</label>
                                <input type="number" name="ano" id="ano" class="form-control" required>
                            </div>
                            <div class="col-md-2">
                                <label for="serie" class="form-label">Série</label>
                                <input type="number" name="serie" id="serie" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <label for="nivel" class="form-label">Nivel de ensino</label>
                                <select class="form-select" name="nivel" id="nivel">
                                    <option value="1">Fundamental</option>
                                    <option value="2">Médio</option>
                                    <option value="3">Superior</option>
                                </select>                                 
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="turno" class="form-label">Turno</label>
                                <select class="form-select" name="turno" id="turno">
                                    <option value="1">Manhã</option>
                                    <option value="2">Tarde</option>
                                    <option value="3">Noite</option>
                                </select>                            
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </form>
                </div>
            </div>

        </div>

@endsection