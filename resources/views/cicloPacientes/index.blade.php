@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
           <h4>CICLOS - PACIENTES</h4>
        </div>
    </div>
    <hr>
    <div class="row mt-4">
        <div class="col-sm-6">
             <form method="POST" action="/ciclos">
                 @csrf
                 <table>
                     <tr><td align="right">Ciclo:&nbsp;</td><td>
                     <select name="ciclo">
                        @foreach ($ciclos as $key => $value)
                            <option value="{{ $value->codigo }}">{{ $value->nombre }}</option>
                        @endforeach
                    </select>
                     </td></tr>
                     <tr><td align="right">Paciente:&nbsp;</td><td>
                     <select name="paciente">
                        @foreach ($pacientes as $key => $value)
                            <option value="{{ $value->rut }}">{{ $value->nombre }}</option>
                        @endforeach
                    </select>    
                      </td></tr>
                     <tr><td></td><td><button type="submit" class="btn btn-secondary">Agregar</button></td></tr>
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
           <H4>LISTADO</H4>           
        </div>
    </div>
</div>

<div class="container">
<div class="row">
        <div class="col-sm-12 justify-content-left">
            @if( count( $registros ) >0 )    
                <table class="table table-dark table-striped mt-4  listado">    
                    <thead>
                    <tr><td>Id</td><td>Codigo</td><td>Nombre</td></td><td>Fecha</td><td>Acción</td></tr>
                    </thead>
                    <tbody>
                @foreach($registros as $registro )
                <tr>
                    <td>{{ $registro->id}}</td>
                    <td>{{ $registro->codigo }}</td>
                    <td>{{ $registro->nombre }}</td>
                    <td>{{ $registro->updated_at }}</td>
                    <td>
                     <div>
                    <a href="/ciclo/{{$ciclo->id}}" class="btn btn-success">Editar</a>  
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$ciclo->id}}">x</button>     
                    </div>
                    </td></tr>

                @endforeach
                </tbody> 
                </table>
            @else
                <br><h4>No Existen Registros En Su Busqueda</h4>
            @endif
        </div>
</div>


@foreach( $registros as $registro  )
<div id="myModal{{$registro->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Advertencia de Eliminacion</h4>
       
      </div>
      <div class="modal-body">
        <p> Esta seguro de querer eliminar al registro:{{$registro->nombre}}?</p>
      </div>
      <div class="modal-footer">
        <form action="{{ route('cicloPaciente.destroy',$ciclo->id) }}" method="POST">                             
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

