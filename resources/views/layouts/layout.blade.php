
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    @yield('css')    
<style>
    .listado {
        font-family:Arial;
        font-size:12px;
        width:100%;
    }


    .listado tr {
        height:12px;
    }

    .verde {
        color:green;
        font-weight: bold;
    }
    .datosPaciente input {
        margin-bottom: 0.3em;
    }


    .white {
        color:black;
        background:white;   
        font-size:9px;
    }

    .green {
        background:green;
        color:white;      
        font-size:9px; 
    }

    .yellow {
        color:black;
        background:yellow; 
        font-size:9px; 
    
    }

    .brown {
        color:white;
        background:#996633;  
        font-size:9px; 
    }

    .orange {
        color:black;
        background:#ff6600; 
        font-size:9px; 
    
    }
    .alturaFila {
        height:30px;
    }
    .botonListado {
        font-size:9px;
    }

    .botonEstadoCiclo {
        font-size:9px;
    }
</style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-12">
        <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
            <a class="navbar-brand" href="#">UMR</a>
            </div>
            <ul class="nav navbar-nav">
            <li class="active"><a href="{{ url('home') }}">Home</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Pacientes
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li><a href="{{ url('/pacientes') }}">Ficha</a></li>
                <li><a href="{{ url('/conyuges') }}">Conyuge</a></li>
                <li><a href="#">Page 1-3</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Procedimientos
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li><a href="{{url('/procedPab')}}">De Pabellon</a></li>
                <li><a href="{{url('/procedimientoLaboratorio')}}">De Laboratorio</a></li>
                </ul>
            </li>
            <li><a href="{{ url('/estadociclos') }}">Estado Ciclos</a></li>
            <li><a href="{{ url('/medicos') }}">Médicos</a></li>
            <li><a href="{{ url('/ciclos') }}">Ciclos</a></li>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Ciclos
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li><a href="{{ url('/ciclos') }}">Crear Ciclos</a></li>
                <li><a href="{{ url('/cicloPacientes') }}">Agregar Paciente</a></li>
                <li><a href="{{ url('/ciclo2s') }}">Crear Ciclos Especial</a></li>

                <li><a href="{{ url('/ciclosListado') }}">Listado ciclos</a></li>
                </ul>
            </li>

            <li class="active"><a href="{{ url('salir') }}">Salir</a></li>
            </ul>
        </div>
        </nav>
        </div>
   </div>
</div>

@yield('content')  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@yield('js')
</body>
</html>