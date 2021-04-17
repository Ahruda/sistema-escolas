<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{url('assets/jquery.min.js')}}"></script>
    <script src="{{url('assets/jquery.inputmask.bundle.js')}}"></script>
    <script src="{{url('assets/bootstrap/js/bootstrap.min.js')}}"></script>

    <link rel="stylesheet" href="{{url('assets/bootstrap/css/bootstrap.min.css')}}">

	<link rel="stylesheet" type="text/css" href="{{url('assets/dataTables/css/jquery.dataTables.css')}}">
    <script type="text/javascript" charset="utf8" src="{{url('assets/dataTables/js/jquery.dataTables.js')}}"></script>

    <script type="text/javascript">
        jQuery(function($){
            $("#telefone").inputmask({
                mask: ["(99) 9999-9999", "(99) 9 9999-9999", ],
                keepStatic: true 
            });
        });
    </script>
    
    <style>
        .dataTables_filter input { 
            width: 300px;
            margin-bottom: 10px; 
        }
        body{
            background-color: #D2D1D0
        }
    </style>
    
    <title>Document</title>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Página Inicial</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">

                <li class="nav-item">
                <a class="nav-link active" href="/escolas">Escolas</a>
                </li>

                <li class="nav-item">
                <a class="nav-link active" href="/turmas">Turmas</a>
                </li>

                <li class="nav-item">
                <a class="nav-link active" href="/alunos">Alunos</a>
                </li>

            </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ session('success') }}</strong> 
            </div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ session('warning') }}</strong> 
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>