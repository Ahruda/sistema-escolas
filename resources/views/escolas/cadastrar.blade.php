@extends('templates.template')

@section('content')

        <div class="col-md-12">

            <div class="card mt-5">
                <div class="card-header">
                    <h2>Cadastro de Escolas</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{url('escolas')}}">

                        @csrf <!-- Fornece segurança ao formulário evitando ataques -->

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" name="nome" id="nome" class="form-control" required>
                            </div>
                            <div class="col-md-5">
                                <label for="endereco" class="form-label">Endereço</label>
                                <input type="text" name="endereco" id="endereco" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="data_insercao" class="form-label">Data de inserção</label>
                                <input type="date" name="data_insercao" id="data_insercao" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="situacao" class="form-label">Situação</label>
                                <select class="form-select" name="situacao" id="situacao">
                                    <option value="1">Ativa</option>
                                    <option value="2">Inativa</option>
                                </select>                            
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </form>
                </div>
            </div>

        </div>

@endsection