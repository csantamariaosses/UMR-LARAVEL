@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
           <h4>MEDICOS</h4>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-sm-6">
             <form method="POST" action="/medicos">
                 @csrf
                 <table>
                     <tr><td align="right">Rut:&nbsp;</td><td><input type="text" name="rut"  id="rut"></td></tr>
                     <tr><td align="right">Nombre:&nbsp;</td><td><input type="text" name="nombre"  id="nombre"></td></tr>
                     <tr><td align="right">Especialidad:&nbsp;</td><td><input type="text" name="especialidad"  id="especialidad"></td></tr>
                     <tr><td></td><td><button type="submit" class="btn btn-secondary">Guardar</button></td></tr>
                </table>
            </form>
        </div>
        <div class="col-sm-6">
        </div>
    </div>
</div>
  
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
            @if( count( $medicos) >0 )    
                <table class="table table-dark table-striped mt-4  listado">    
                    <thead>
                    <tr><td>Id</td><td>Rut</td><td>Nombre</td><td>Especialidad</td><td>Fecha</td><td>Acción</td></tr>
                    </thead>
                    <tbody>
                @foreach($medicos as $medico)
                <tr>
                    <td>{{$medico->id}}</td>

                    <td>{{$medico->rut}}</td>
                    <td>{{$medico->nombre}}</td>
                    <td>{{$medico->especialidad}}</td>
                    <td>{{$medico->updated_at}}</td>
                    <td>
                     <div>
                    <a href="/medicos/{{$medico->id}}" class="btn btn-info">Editar</a>  
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$medico->id}}">x</button>     
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


@foreach($medicos as $medico )
<div id="myModal{{$medico->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Advertencia de Eliminacion</h4>
       
      </div>
      <div class="modal-body">
        <p> Esta seguro de querer eliminar al usuario:{{$medico->nombre}}?</p>
      </div>
      <div class="modal-footer">
        <form action="{{ route('medicos.destroy',$medico->id) }}" method="POST">                             
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

