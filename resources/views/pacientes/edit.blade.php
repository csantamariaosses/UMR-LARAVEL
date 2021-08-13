@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
          <h4>PACIENTES - <span class="verde">EDITAR</span></h4>
        </div>
    </div>
    <hr>
    <div class="row mt-4">
        <div class="col-sm-6">
             <form method="POST" action="/pacientes/{{$paciente->id}}">
                 @method("PUT")
                 @csrf
                 <p>DATOS PACIENTE</p>
                 <table class="datosPaciente">
                     <tr><td align="right">Rut:&nbsp;</td><td><input type="text" name="rut"  id="rut" value="{{ $paciente->rut}}">&nbsp;&nbsp;</td></tr>
                     <tr><td align="right">Nombre:&nbsp;</td><td><input type="text" name="nombre"  id="nombre" size="60"  value="{{ $paciente->nombre}}"></td></tr>
                     <tr><td align="right">Direccion:&nbsp;</td><td><input type="text" name="direccion"  id="direccion" size="60"  value="{{ $paciente->direccion}}"></td></tr>
                     <tr><td align="right">Email:&nbsp;</td><td><input type="email" name="email"  id="email" size="60"  value="{{ $paciente->email}}"></td></tr>
                     <tr><td align="right">Telefono:&nbsp;</td><td><input type="text" name="telefono"  id="telefono"  value="{{ $paciente->telefono}}"></td></tr>
                     <tr><td align="right">Fecha Nac.:&nbsp;</td><td><input type="date" name="fechaNac"  id="fechaNac"  value="{{ $paciente->fechaNacimiento}}"></td></tr>
                     <tr><td align="right">Diagnóstico:&nbsp;</td><td><textarea name="diagnostico" cols="60" rows="2">{{$paciente->diagnostico}}</textarea> </td></tr>
                     <tr><td align="right">Observaciones:&nbsp;</td><td><textarea name="observaciones" cols="60" rows="3">{{ $paciente->observaciones}}</textarea> </td></tr>
                     
                </table>
                <hr>
                <p>DATOS CONYUGE</p>  
                <table class="datosPaciente">
                     <tr><td align="right">Rut:&nbsp;</td><td><input type="text" name="rutConyuge"  id="rutConyuge" value="{{ $conyuge->rut}}"></td></tr>
                     <tr><td align="right">Nombre:&nbsp;</td><td><input type="text" name="nombreConyuge"  id="nombreConyuge" size="60" value="{{ $conyuge->nombre}}"></td></tr>
                     <tr><td align="right">Direccion:&nbsp;</td><td><input type="text" name="direccionConyuge"  id="direccionConyuge" size="60"  value="{{ $conyuge->direccion}}"></td></tr>
                     <tr><td align="right">Email:&nbsp;</td><td><input type="email" name="emailConyuge"  id="emailConyuge" size="60"  value="{{ $conyuge->email}}"></td></tr>
                     <tr><td align="right">Telefono:&nbsp;</td><td><input type="text" name="telefonoConyuge"  id="telefonoConyuge"  value="{{ $conyuge->telefono}}"></td></tr>
                     <tr><td align="right">Fecha Nac.:&nbsp;</td><td><input type="date" name="fechaNacConyuge"  id="fechaNacConyuge"  value="{{ $conyuge->fechaNacimiento}}"></td></tr>
                     <tr><td align="right">Antec. Morbidos:&nbsp;</td><td><input type="text" name="antecMorbConyuge"  id="antecMorbConyuge" size="60"  value="{{ $conyuge->antecedMorbidos}}"></td></tr>
                     <tr><td align="right">Observaciones:&nbsp;</td><td><textarea name="observacionesConyuge" cols="60" rows="3"> {{ $conyuge->observaciones}}</textarea></td></tr>
                     <tr><td></td><td><button type="submit" class="btn btn-secondary">Guardar</button></td></tr>
                </table>
            </form>
        </div>
        <div class="col-sm-6">
            
        </div>
    </div>
</div>
 <HR> 
<div class="container">
    <div class="row">
        <div class="col-12">
           <p align="left">LISTADO</p>           
        </div>
    </div>
</div>

<div class="container">
<div class="row">

        <div class="col-sm-12 justify-content-center">
            @if( count( $pacientes) >0 )    
                <table class="table table-dark table-striped mt-4 listado">   
                    <thead> 
                        <tr><td>Id</td><td>Rut</td><td>Nombre</td><td>Fecha</td><td>Edad</td><td>Acción</td></tr>
                    </thead>
                    <tbody>
                @foreach($pacientes as $paciente)
                  <tr>
                    <td>{{$paciente->id}}</td>
                    <td>{{$paciente->rut}}</td>
                    <td>{{$paciente->nombre}}</td>
                    <td>{{$paciente->fechaNacimiento}}</td>
                    <td>{{$paciente->edad}}
                    <td>{{$paciente->updated_at}}</td>
                    <td>

                    <div>
                    <a href="/pacientes/{{$paciente->id}}" class="btn btn-success">Editar</a>  
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$paciente->id}}">x</button>     
                    </div>

                    </td></tr>

                @endforeach 
                <tbody>
                </table>
            @else
                <br><h4>No Existen Productos En Su Busqueda</h4>
            @endif
        </div>

</div>



@foreach( $pacientes as $paciente  )
<div id="myModal{{$paciente->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Advertencia de Eliminacion</h4>
       
      </div>
      <div class="modal-body">
        <p> Esta seguro de querer eliminar al registro:{{$paciente->nombre}}?</p>
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