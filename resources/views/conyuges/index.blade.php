@extends('layouts.layout')
@section("css")
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css"/> -->
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
           <h4>CONYUGES</h4>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-sm-6">
             <form method="POST" action="/conyuges">
                 @csrf                 
            
                <p>DATOS CONYUGE</p>  
                <table class="datosPaciente">
                     <tr><td align="right">Rut:&nbsp;</td><td><input type="text" name="rutConyuge"  id="rutConyuge" onBlur="verifRutConyuge( this)"></td></tr>
                     <tr><td align="right">Nombre:&nbsp;</td><td><input type="text" name="nombreConyuge"  id="nombreConyuge" size="60"></td></tr>
                     <tr><td align="right">Direccion:&nbsp;</td><td><input type="text" name="direccionConyuge"  id="direccionConyuge" size="60"></td></tr>
                     <tr><td align="right">Email:&nbsp;</td><td><input type="email" name="emailConyuge"  id="emailConyuge" size="60"></td></tr>
                     <tr><td align="right">Telefono:&nbsp;</td><td><input type="text" name="telefonoConyuge"  id="telefonoConyuge"></td></tr>
                     <tr><td align="right">Fecha Nac.:&nbsp;</td><td><input type="date" name="fechaNacConyuge"  id="fechaNacConyuge"></td></tr>
                     <tr><td align="right">Antec. Morbidos:&nbsp;</td><td><input type="text" name="antecMorbConyuge"  id="antecMorbConyuge" size="60"></td></tr>
                     <tr><td align="right">Observaciones:&nbsp;</td><td><textarea name="observacionesConyuge" cols="60" rows="3"></textarea></td></tr>
                     <tr><td></td><td><button type="submit" class="btn btn-secondary">Guardar</button></td></tr>
                </table>
            </form>
        </div>
        <div class="col-sm-6">
        </div>
    </div>
</div>
  <hr>
<div class="container">
    <div class="row">
        <div class="col-12">
           <p align="left">LISTADO</p>           
        </div>
    </div>
</div>

<div class="container">
<div class="row">
        <div class="col-sm-12 justify-content-left">
            @if( count( $conyuges) >0 )    
                <table id="conyuges" class="table table-dark table-striped mt-4  listadoPacteConyuge">    
                    <thead>
                    <tr><td>Id</td><td>Rut</td><td>Nombre</td><td>FechaNac.</td><td>Edad</td><td>Telefono</td><td>Acción</td></tr>
                    </thead>
                    <tbody>
                @foreach($conyuges as $conyuge )
                <tr>
                    <td>{{$conyuge->id}}</td>
                    <td>{{$conyuge->rut}}</td>
                    <td>{{$conyuge->nombre}}</td>
                    <td>{{$conyuge->fechaNacimiento}}</td>
                    <td>{{$conyuge->edad}}
                    <td>{{$conyuge->telefono}}</td>
                    <td>
                     <div>
                    <a href="/conyuges/{{$conyuge->id}}" class="btn btn-info">Editar:</a>  
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$conyuge->id}}">x</button>     
                    </div>
                    </td></tr>

                @endforeach
                </tbody> 
                </table>
            @else
                <br><h4>No Existen Productos En Su Busqueda</h4>
            @endif
        </div>
</div>


@foreach($conyuges as $conyuge )
<div id="myModal{{$conyuge->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Advertencia de Eliminacion</h4>
       
      </div>
      <div class="modal-body">
        <p> Esta seguro de querer eliminar al paciente:{{$conyuge->nombre}}?</p>
      </div>
      <div class="modal-footer">
        <form action="{{ route('conyuges.destroy',$conyuge->id) }}" method="POST">                             
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
    $('#conyuges').DataTable();
} );
</script>
<script>
  function verifRutConyuge( rut ) {
        console.log("Rut:" + rut.value);
        var _rut = rut.value;
        
        $.ajax({
            type: "get",
            url: "{{route('conyuge.rut')}}", 
            dataType:'json',
            data: { rut:_rut },
            success: function ( data ) {
                console.log( data  );
                if( data.success != null ) { 
                    $("#nombreConyuge").val( data.success.nombre ); 
                    $("#direccionConyuge").val( data.success.direccion ); 
                    $("#emailConyuge").val( data.success.email ); 
                    $("#telefonoConyuge").val( data.success.telefono ); 
                    $("#fechaNacConyuge").val( data.success.fechaNacimiento ); 
                    $("#diagnosticoConyuge").val( data.success.diagnostico ); 
                    $("#observacionesConyuge").val( data.success.observaciones ); 
                }                               
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
               console.log("Status: " + textStatus); ; 
            }     
        });
        
    }
</script>
@stop


