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
        .dataTables_filter input { width: 300px }
    </style>
    
    <title>Document</title>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>