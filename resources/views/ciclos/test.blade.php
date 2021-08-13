@extends('layouts.layout')

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
             <form method="POST" action="/ciclosTest">
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
                <table class="table table-dark table-striped mt-4  listado">    
                    <thead>
                    <tr><td>Id</td><td>Rut</td><td>Nombre</td><td>Fecha</td><td>Acción</td></tr>
                    </thead>
                    <tbody>
                @foreach($ciclo2s as $ciclo )
                <tr>
                    <td>{{ $ciclo->id}}</td>
                    <td>{{ $ciclo->paciente->rut }}</td>
                    <td>{{ $ciclo->paciente->nombre }}</td>
                    <td>{{ $ciclo->updated_at }}</td>
                    <td>
                     <div>
                    <a href="/ciclos/{{$ciclo->id}}" class="btn btn-success">Editar</a>  
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


@foreach( $ciclo2s as $ciclo  )
<div id="myModal{{$ciclo->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Advertencia de Eliminacion</h4>
       
      </div>
      <div class="modal-body">
        <p> Esta seguro de querer eliminar al registro:{{$ciclo->nombre}}?</p>
      </div>
      <div class="modal-footer">
        <form action="{{ route('ciclos.destroy',$ciclo->id) }}" method="POST">                             
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

