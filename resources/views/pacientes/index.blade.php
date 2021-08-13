@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
           <h4>PACIENTES</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
        <div class="alert alert-danger">{{$msg}}</div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-sm-6">
             <form method="POST" action="/pacientes">
                 @csrf
                 <p>DATOS PACIENTE</p>
                 <table class="datosPaciente">
                     <tr><td align="right">Rut:&nbsp;</td><td><input type="text" name="rut"  id="rut" required></td></tr>
                     <tr><td align="right">Nombre:&nbsp;</td><td><input type="text" name="nombre"  id="nombre" size="60" required></td></tr>
                     <tr><td align="right">Direccion:&nbsp;</td><td><input type="text" name="direccion"  id="direccion" size="60"></td></tr>
                     <tr><td align="right">Email:&nbsp;</td><td><input type="email" name="email"  id="email" size="60" required></td></tr>
                     <tr><td align="right">Telefono:&nbsp;</td><td><input type="text" name="telefono"  id="telefono" required></td></tr>
                     <tr><td align="right">Fecha Nac.:&nbsp;</td><td><input type="date" name="fechaNac"  id="fechaNac" required></td></tr>
                     <tr><td align="right">Diagnóstico:&nbsp;</td><td><textarea name="diagnostico" cols="60" rows="2" ></textarea></td></tr>
                     <tr><td align="right">Observaciones:&nbsp;</td><td><textarea name="observaciobnes" cols="60" rows="3"></textarea></td></tr>
                     
                </table>
                <hr>
                <p>DATOS CONYUGE</p>  
                <table class="datosPaciente">
                     <tr><td align="right">Rut:&nbsp;</td><td><input type="text" name="rutConyuge"  id="rutConyuge"></td></tr>
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
            @if( count( $pacientes) >0 )    
                <table class="table table-dark table-striped mt-4  listado">    
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

