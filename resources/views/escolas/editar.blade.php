@extends('templates.template')

@section('content')

        <div class="col-md-12">

            <div class="card mt-3">
                <div class="card-header">
                    <h2>Editar dados da escola</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{url("escolas/$escola->id")}}">
                        @method('PUT')
                        @csrf <!-- Fornece segurança ao formulário evitando ataques -->

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="{{$escola->nome}}" required>
                            </div>
                            <div class="col-md-5">
                                <label for="endereco" class="form-label">Endereço</label>
                                <input type="text" name="endereco" id="endereco" class="form-control" value="{{$escola->endereco}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="data_insercao" class="form-label">Data de inserção</label>
                                <input type="date" name="data_insercao" id="data_insercao" class="form-control" value="{{$escola->data_insercao}}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="situacao" class="form-label">Situação</label>
                                <select class="form-select" name="situacao" id="situacao">
                                    @if( ($escola->situacao) == 1 )
                                        <option value="1" selected>Ativa</option>
                                        <option value="2">Inativa</option>
                                    @else
                                        <option value="1">Ativa</option>
                                        <option value="2" selected>Inativa</option>
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