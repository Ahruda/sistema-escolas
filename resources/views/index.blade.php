@extends('templates.template')

@section('content')

    <div class="row mt-5">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                  <h2>Escolas</h2>
                </div>
                <div class="card-text">
                    Clique aqui
                </div>
              </div>
        </div>

        <div class="col-md-1"></div>

        <div class="col-md-3">
            <a href="#" style="text-decoration:none;color:black">
                <div class="card">
                    <div class="card-body text-center">
                    <h2>Turmas</h2>
                    </div>
                    <div class="card-text text-center mb-2">
                        Clique aqui
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-1"></div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                  <h2>Alunos</h2>
                </div>
                <div class="card-text">
                    Clique aqui
                </div>
              </div>
        </div>
    </div>

@endsection