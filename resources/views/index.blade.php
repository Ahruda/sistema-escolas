@extends('templates.template')

@section('content')

<style>
    .menu-opcao:hover{
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);   
    }
</style>

    <div class="row mt-5 text-center">
        <h1>Teste de Seleção - Transtassi</h1>
        <h3>Leonardo Galbiere Arruda</h3>
    </div>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card mt-5">
                <div class="card-header">
                    <h2>Menu de opções</h2>
                </div>
                <div class="card-body">
                    <div class="row mt-4">
                        
                        <div class="col">
                            <a href="escolas" style="text-decoration:none;color:black">
                                <div class="card border-secondary menu-opcao border-2">
                                    <div class="card-body text-center">
                                    <h2>Escolas</h2>
                                    </div>
                                    <div class="card-text text-center mb-4">
                                        Clique aqui
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col">
                            <a href="turmas" style="text-decoration:none;color:black">
                                <div class="card border-secondary menu-opcao border-2">
                                    <div class="card-body text-center">
                                    <h2>Turmas</h2>
                                    </div>
                                    <div class="card-text text-center mb-4">
                                        Clique aqui
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col">
                            <a href="alunos" style="text-decoration:none;color:black">
                                <div class="card border-secondary menu-opcao border-2">
                                    <div class="card-body text-center">
                                    <h2>Alunos</h2>
                                    </div>
                                    <div class="card-text text-center mb-4">
                                        Clique aqui
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    <div class="col-md-1"></div>

@endsection