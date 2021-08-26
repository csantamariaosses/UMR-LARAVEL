@extends('layouts.layout')

@section("css")
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css"/>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
           <h4>PACIENTES</h4>
        </div>
    </div>
    <div class="row mt-4">
       
             <form method="POST" action="/pacientes">
                 @csrf
                 <div class="col-sm-6">
                 <p>DATOS PACIENTE</p>
                 <table class="datosPaciente">
                     <tr><td align="right">Rut:&nbsp;</td><td><input type="text" name="rut"  id="rut"  required onBlur="verifRutPcte(this)"></td></tr>
                     <tr><td align="right">Nombre:&nbsp;</td><td><input type="text" name="nombre"  id="nombre" size="40" required></td></tr>
                     <tr><td align="right">Direccion:&nbsp;</td><td><input type="text" name="direccion"  id="direccion" size="40"></td></tr>
                     <tr><td align="right">Email:&nbsp;</td><td><input type="email" name="email"  id="email" size="40" required></td></tr>
                     <tr><td align="right">Telefono:&nbsp;</td><td><input type="text" name="telefono"  id="telefono" required></td></tr>
                     <tr><td align="right">Fecha Nac.:&nbsp;</td><td><input type="date" name="fechaNac"  id="fechaNac" required onBlur="calcularEdad2(this)">&nbsp;&nbsp;&nbsp;Edad:<span id="edadPcte"></span>&nbsp;años</td></tr>
                     <tr><td align="right">Diagnóstico:&nbsp;</td><td><textarea name="diagnostico" id="diagnostico"  cols="40" rows="2" ></textarea></td></tr>
                     <tr><td align="right">Anteed. Morbidos:&nbsp;</td><td><textarea name="antecedMorbidos"  id="antecedMorbidos" cols="40" rows="2" ></textarea></td></tr>
                     <tr><td align="right">Observaciones:&nbsp;</td><td><textarea name="observaciobnes" id="observaciobnes" cols="40" rows="3"></textarea></td></tr>
                     
                </table>
                </div>

                <div class="col-sm-6">
                <p>DATOS CONYUGE</p>  
                <table class="datosPaciente">
                     <tr><td align="right">Rut:&nbsp;</td><td><input type="text" name="rutConyuge"  id="rutConyuge" onBlur="verifRutConyuge(this)"></td></tr>
                     <tr><td align="right">Nombre:&nbsp;</td><td><input type="text" name="nombreConyuge"  id="nombreConyuge" size="40"></td></tr>
                     <tr><td align="right">Direccion:&nbsp;</td><td><input type="text" name="direccionConyuge"  id="direccionConyuge" size="40"></td></tr>
                     <tr><td align="right">Email:&nbsp;</td><td><input type="email" name="emailConyuge"  id="emailConyuge" size="40"></td></tr>
                     <tr><td align="right">Telefono:&nbsp;</td><td><input type="text" name="telefonoConyuge"  id="telefonoConyuge"></td></tr>
                     <tr><td align="right">Fecha Nac.:&nbsp;</td><td><input type="date" name="fechaNacConyuge"  id="fechaNacConyuge"></td></tr>
                     <tr><td align="right">Observaciones:&nbsp;</td><td><textarea name="observacionesConyuge" id="observacionesConyuge" cols="40" rows="3"></textarea></td></tr>
                     <tr><td></td><td><button type="submit" class="btn btn-secondary">Guardar</button></td></tr>
                </table>
                </div>
            </form>
    </div>
</div>
  <hr>
<div class="container">
    <div class="row">
        <div class="col-12">
           <p align="left">LISTADO::</p>           
        </div>
    </div>
</div>

<div class="container">
<div class="row">
        <div class="col-sm-12 justify-content-left">
            @if( count( $pacientes) >0 )    
                <table id="pacientes" class="table table-dark table-striped mt-4  listado">    
                    <thead>
                    <tr><td>Id</td><td>Rut</td><td>Nombre</td><td>FechaNac.</td><td>Edad</td><td>Telefono</td><td>Acción</td></tr>
                    </thead>
                    <tbody>
                @foreach($pacientes as $paciente )
                <tr>
                    <td>{{$paciente->id}}</td>
                    <td>{{$paciente->rut}}</td>
                    <td>{{$paciente->nombre}}</td>
                    <td>{{$paciente->fechaNacimiento}}</td>
                    <td>{{$paciente->edad}}
                    <td>{{$paciente->telefono}}</td>
                    <td>
                     <div>
                    <a href="/pacientes/{{$paciente->id}}" class="btn btn-info">Editar</a>  
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$paciente->id}}">x</button>     
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


@foreach($pacientes as $paciente )
<div id="myModal{{$paciente->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Advertencia de Eliminacion</h4>
       
      </div>
      <div class="modal-body">
        <p> Esta seguro de querer eliminar al paciente:{{$paciente->nombre}}?</p>
      </div>
      <div class="modal-footer">
        <form action="{{ route('pacientes.destroy',$paciente->id) }}" method="POST">                             
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
 
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {
    $('#pacientes').DataTable(
        {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    }

    );
} );
</script>

<script>
    function verifRutPcte( rut ) {
        console.log("Rut:" + rut.value);

        var _token = $("input[name='_token']").val();
        var _rut = rut.value;

        console.log("_token:"+ _token);
        
        $.ajax({
            type: "get",
            url: "{{route('paciente.rut')}}", 
            dataType:'json',
            data: { rut:_rut },
            success: function ( data ) {
                console.log( data  );
                if( data.success != null ) { 
                    $("#nombre").val( data.success.nombre ); 
                    $("#direccion").val( data.success.direccion ); 
                    $("#email").val( data.success.email ); 
                    $("#telefono").val( data.success.telefono ); 
                    $("#fechaNac").val( data.success.fechaNacimiento ); 
                    $("#diagnostico").val( data.success.diagnostico ); 
                    $("#antecedMorbidos").val( data.success.antecedMorbidos ); 
                    $("#observaciones").val( data.success.observaciones ); 

                    if( data.success.rutConyuge != "") {
                        console.log("Buscar datos rut:" + data.success.rutConyuge);
                        var _rutConyuge = data.success.rutConyuge;
                        $.ajax({
                            type: "get",
                            url: "{{route('conyuge.rut')}}", 
                            dataType:'json',
                            data: { rut:_rutConyuge },
                            success: function ( data ) {
                                console.log( data  );
                                if( data.success != null ) { 
                                    $("#rutConyuge").val( data.success.rut ); 
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
                }                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
               console.log("Status: " + textStatus); ; 
            }     
        });
        
    }



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


    function printMsg (msg) {
              if($.isEmptyObject(msg.error)){
                  console.log(msg.success);
                  $('.alert-block').css('display','block').append('<strong>'+msg.success+'</strong>');
              }else{
                $.each( msg.error, function( key, value ) {
                  $('.'+key+'_err').text(value);
                });
              }
    }


    function calcularEdad(fecha) {
        var hoy = new Date();
        var cumpleanos = new Date(fecha);
        var edad = hoy.getFullYear() - cumpleanos.getFullYear();
        var m = hoy.getMonth() - cumpleanos.getMonth();

        if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
            edad--;
        }

        return edad;
    }

    function calcularEdad2( fecha ) {
        var edad = calcularEdad( fecha.value);
        document.getElementById("edadPcte").innerHTML = edad;
    }

    
</script>
@stop
