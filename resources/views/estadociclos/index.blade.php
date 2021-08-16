@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
           <h4>ESTADO CICLOS</h4>
        </div>
    </div>

    <div class="row">
                
        @if( $msgType == "warning" )    
        <div class="alert alert-danger">
        <!-- you missed this line of code -->
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ $msg }}}}
       </div>
       @endif
       @if( $msgType == "success" )    
        <div class="alert alert-info">
        <!-- you missed this line of code -->
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ $msg }}}}
       </div>
       @endif
    </div>
    
    <div class="row mt-4">
        <div class="col-sm-6">
             <form method="POST" action="/estadociclos">
                 @csrf
                 <table>                     
                     <tr><td align="right">Nombre:&nbsp;</td><td><input type="text" name="nombre"  id="nombre" required></td></tr>
                     <tr><td></td><td><button type="submit" class="btn btn-secondary">Guardar</button></td></tr>
                </table>
            </form>
        </div>
        <div class="col-sm-6">
        </div>
    </div>
</div>
<br>
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
            @if( count( $estadociclos) >0 )    
                <table class="table table-dark table-striped mt-4  listado">    
                    <thead>
                    <tr><td>Id</td><td>Nombre</td></td><td>Fecha</td><td>Acción</td></tr>
                    </thead>
                    <tbody>
                @foreach($estadociclos as $estadociclo)
                <tr>
                    <td>{{$estadociclo->id}}</td>

                    <td>{{$estadociclo->nombre}}</td>
                    <td>{{$estadociclo->updated_at}}</td>
                    <td>
                     <div>
                    <a href="/estadociclos/{{$estadociclo->id}}" class="btn btn-info">Editar</a>  
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$estadociclo->id}}">x</button>     
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


@foreach($estadociclos as $estadociclo )
<div id="myModal{{$estadociclo->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Advertencia de Eliminacion</h4>
       
      </div>
      <div class="modal-body">
        <p> Esta seguro de querer eliminar al usuario:{{$estadociclo->nombre}}?</p>
      </div>
      <div class="modal-footer">
        <form action="{{ route('estadociclos.destroy',$estadociclo->id) }}" method="POST">                             
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

