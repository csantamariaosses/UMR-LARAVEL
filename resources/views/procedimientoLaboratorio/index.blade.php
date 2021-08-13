@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
           <h4>PROCEDIMIENTOS - LABORATORIO</h4>
        </div>
    </div>
    <hr>
    <div class="row mt-4">
        <div class="col-sm-6">
             <form method="POST" action="/procedimientoLaboratorio">
                 @csrf
                 <table>
                     <tr><td align="right">Codigo:&nbsp;</td><td><input type="text" name="codigo"  id="codigo" required></td></tr>
                     <tr><td align="right">Nombre:&nbsp;</td><td><input type="text" name="nombre"  id="nombre" required></td></tr>
                     <tr><td align="right">Precio:&nbsp;</td><td><input type="text" name="precio"  id="precio"></td></tr>
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
           <H4>LISTADO</H4>           
        </div>
    </div>
</div>

<div class="container">
<div class="row">
        <div class="col-sm-12 justify-content-left">
            @if( count( $procedLabs) >0 )    
                <table class="table table-dark table-striped mt-4  listado">    
                    <thead>
                    <tr><td>Id</td><td>Codigo</td><td>Nombre</td><td>Precio</td><td>Fecha</td><td>Acción</td></tr>
                    </thead>
                    <tbody>
                @foreach($procedLabs as $procedLab )
                <tr>
                    <td>{{ $procedLab->id}}</td>
                    <td>{{ $procedLab->codigo }}</td>
                    <td>{{ $procedLab->nombre }}</td>
                    <td>{{ $procedLab->precio }}</td>
                    <td>{{ $procedLab->updated_at }}</td>
                    <td>
                     <div>
                    <a href="/procedimientoLaboratorio/{{$procedLab->id}}" class="btn btn-success">Editar</a>  
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$procedLab->id}}">x</button>     
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


@foreach( $procedLabs as $procedLab  )
<div id="myModal{{$procedLab->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Advertencia de Eliminacion</h4>
       
      </div>
      <div class="modal-body">
        <p> Esta seguro de querer eliminar al registro:{{$procedLab->nombre}}?</p>
      </div>
      <div class="modal-footer">
        <form action="{{ route('procedimientoLaboratorio.destroy',$procedLab->id) }}" method="POST">                             
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

