@extends('layouts.layout')
@section("css")
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
           <h4>CICLOS</h4>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
        <div class="alert alert-danger">{{$msg}}</div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-sm-6">
             <form method="POST" action="/ciclo2s">
                 @csrf
                 <table>
                     <tr><td align="right">Rut Paciente:&nbsp;</td><td><input type="text" name="rutPaciente"  id="rutPaciente" required></td></tr>
                    <!--  <tr><td align="right">Rut Conyuge:&nbsp;</td><td><input type="text" name="rutConyuge"  id="rutConyuge" required></td></tr>
                     <tr><td align="right">Rut Medico:&nbsp;</td><td><input type="text" name="rutMedico"  id="rutMedico" required></td></tr>-->
                     <tr><td></td><td><button type="submit" class="btn btn-secondary">Crear Ciclo</button></td></tr>
                </table>
            </form>
        </div>
        <div class="col-sm-6">            
        </div>
    </div>
</div>
 <HR>

 <hr>
<div class="container">
    <div class="row">
        <div class="col-12">
           <H4>LISTADO</H4>           
        </div>
    </div>
</div>

<div class="container">
<div class="row">
        <div class="col-sm-12 justify-content-left">
            @if( count( $ciclo2s ) >0 )    
                <table id="ciclos" class="table table-dark table-striped mt-4  listado">    
                    <thead>
                    <tr><td>Id</td>
                    <td>Estado</td>
                    <td>Rut</td>
                    <td>Nombre</td>
                    <td>Conyuge</td>
                    <td>Medico</td>
                    <td>FechaRegla</td>
                    <td>Fecha</td>
                    <td>Acción</td>
                  </tr>
                    </thead>
                    <tbody>
                @foreach($ciclo2s as $ciclo2 )
                <tr>
                    <td>{{ $ciclo2->id}}</td>
        
        
                    @if( $ciclo2->estadociclo->nombre == "SIN EMPEZAR")
                      <td><button type="button" class="botonEstadoCiclo white  btn-block" >{{ $ciclo2->estadociclo->nombre }}</button></td>
                    @endif

                    @if( $ciclo2->estadociclo->nombre == "INICIADO")
                      <td><button type="button" class="botonEstadoCiclo brown btn-block" >{{ $ciclo2->estadociclo->nombre }}</button></td>
                    @endif
                    @if( $ciclo2->estadociclo->nombre == "EN EVOLUCION")
                      <td><button type="button" class="botonEstadoCiclo yellow  btn-block" >{{ $ciclo2->estadociclo->nombre }}</button></td>
                    @endif
                    @if( $ciclo2->estadociclo->nombre == "TERMINADA")
                      <td><button type="button" class="botonEstadoCiclo green  btn-block" >{{ $ciclo2->estadociclo->nombre }}</button></td>
                    @endif
                    @if( $ciclo2->estadociclo->nombre == "CANCELADA")
                      <td><button type="button" class="botonEstadoCiclo orange  btn-block" >{{ $ciclo2->estadociclo->nombre }}</button></td>
                    @endif
                    <td>{{ $ciclo2->paciente->rut }}</td>
                    <td>{{ $ciclo2->paciente->nombre }}</td>
                    <td>@if(is_null( $ciclo2->conyuge) )
                           &nbsp;
                        @else
                           {{ $ciclo2->conyuge->nombre}}
                        @endif
                    </td>
                    <td>@if(is_null( $ciclo2->medico) )
                           &nbsp;
                        @else
                           {{ $ciclo2->medico->nombre}}
                        @endif

                    </td>
                    <td>{{ $ciclo2->fechaRegla }}</td>
                    <td>{{ $ciclo2->updated_at }}</td>
                    <td>
                     <div>
                    <a href="/ciclo2s/{{$ciclo2->id}}" class="btn btn-success botonListado">Editar</a>  
                    <button type="button" class="btn btn-danger botonListado" data-toggle="modal" data-target="#myModal{{$ciclo2->id}}">x</button>     
                    </div>
                    </td></tr>

                @endforeach
                </tbody> 
                </table>
            @else
                <br><h4>No Existen Registros Que Mostrar</h4>
            @endif
        </div>
</div>


@foreach( $ciclo2s as $ciclo2  )
<div id="myModal{{$ciclo2->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Advertencia de Eliminacion</h4>
       
      </div>
      <div class="modal-body">
        <p> Esta seguro de querer eliminar al registro:{{$ciclo2->nombre}}?</p>
      </div>
      <div class="modal-footer">
        <form action="{{ route('ciclo2s.destroy',$ciclo2->id) }}" method="POST">                             
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar..</button>
         </form>   
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
</div>
 @endforeach
@stop
@section("js")
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#ciclos').DataTable();
} );
</script>
@stop

