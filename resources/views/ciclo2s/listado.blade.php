@extends('layouts.layout')
@section("css")
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
           <h4>LISTADO - CICLOS</h4>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
        <div class="alert alert-danger">{{$msg}}</div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
        <div><b>Regla</b></div>
        </div>
        <div class="col-sm-4">
        <div><b>Estado Ciclo</b></div>
        </div>
        <div class="col-sm-4">
        <div><b>Procedimiento</b></div>
        </div>
    </div>

    <div class="row mt-4">        
       
             <form method="POST" action="/ciclo2s">
                 @csrf
                 <div class="col-sm-4">
                 <table>
                     <tr><td align="right">Fecha Desde:&nbsp;</td><td><input type="date" name="fechaDesde"  id="fechaDesde" required></td></tr>
                     <tr><td align="right">Fecha Hasta:&nbsp;</td><td><input type="date" name="fechaHasta"  id="fechaHasta" required></td></tr>
                     
                </table>
                </div>
                <div class="col-sm-4">
                 <table>
                     <tr><td align="right">Estado:&nbsp;</td><td><select name="estadociclo"><option>Seleccione...</option></select></td></tr>
                     <tr><td></td><td><button type="submit" class="btn btn-secondary">Crear Ciclo</button></td></tr>
                </table>
                </div>
            </form>
        
        <div class="col-sm-6">            
        </div>
    </div>
    <div class="row">
        <div class="col-12">
        <div><b>Regla</b></div>
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
                    <tr><td>Id</td><td>Estado</td><td>Rut</td><td>Nombre</td><td>Conyuge</td><td>Medico</td><td>Fecha</td><td>Acción</td></tr>
                    </thead>
                    <tbody>
                @foreach($ciclo2s as $ciclo2 )
                <tr>
                    <td>{{ $ciclo2->id}}</td>
                    <td>{{ $ciclo2->estadociclo->nombre }}</td>
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
                    <td>{{ $ciclo2->updated_at }}</td>
                    <td>
                     <div>
                    <a href="/ciclo2s/{{$ciclo2->id}}" class="btn btn-success">Editar</a>  
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$ciclo2->id}}">x</button>     
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

