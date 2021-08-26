@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
          <h4>CONYUGES - <span class="verde">EDITAR</span></h4>
        </div>
    </div>
    <hr>
    <div class="row mt-4">
        <div class="col-sm-6">
             <form method="POST" action="/conyuges/{{$conyuge->id}}">
                 @method("PUT")
                 @csrf
                <p>DATOS CONYUGE</p>  
                <table class="datosPaciente">
                     <tr><td align="right">Id:&nbsp;</td><td><input type="text" name="idConyuge"  id="idConyuge" value="{{ $conyuge->id}}" disabled></td></tr>
                     <tr><td align="right">Rut:&nbsp;</td><td><input type="text" name="rutConyuge"  id="rutConyuge" value="{{ $conyuge->rut}}"></td></tr>
                     <tr><td align="right">Nombre:&nbsp;</td><td><input type="text" name="nombreConyuge"  id="nombreConyuge" size="60" value="{{ $conyuge->nombre}}"></td></tr>
                     <tr><td align="right">Direccion:&nbsp;</td><td><input type="text" name="direccionConyuge"  id="direccionConyuge" size="60"  value="{{ $conyuge->direccion}}"></td></tr>
                     <tr><td align="right">Email:&nbsp;</td><td><input type="email" name="emailConyuge"  id="emailConyuge" size="60"  value="{{ $conyuge->email}}"></td></tr>
                     <tr><td align="right">Telefono:&nbsp;</td><td><input type="text" name="telefonoConyuge"  id="telefonoConyuge"  value="{{ $conyuge->telefono}}"></td></tr>
                     <tr><td align="right">Fecha Nac.:&nbsp;</td><td><input type="date" name="fechaNacConyuge"  id="fechaNacConyuge"  value="{{ $conyuge->fechaNacimiento}}">&nbsp;&nbsp;Edad:{{  $conyuge->edad }}&nbsp;&nbsp;años</td></tr>
                     <tr><td align="right">Antec. Morbidos:&nbsp;</td><td><input type="text" name="antecMorbConyuge"  id="antecMorbConyuge" size="60"  value="{{ $conyuge->antecedMorbidos}}"></td></tr>
                     <tr><td align="right">Observaciones:&nbsp;</td><td><textarea name="observacionesConyuge" cols="60" rows="3"> {{ $conyuge->observaciones}}</textarea></td></tr>
                     <tr><td></td><td><button type="submit" class="btn btn-secondary">Guardar</button><a class="btn btn-primary" href="{{route('conyuges.index')}}" role="button">Cancelar</a></td></tr>
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
            @if( count( $conyuges) >0 )    
                <table class="table table-dark table-striped mt-4 listadoPacteConyuge">   
                    <thead> 
                        <tr><td>Id</td><td>Rut</td><td>Nombre</td><td>Fecha</td><td>Edad</td><td>Acción</td></tr>
                    </thead>
                    <tbody>
                @foreach($conyuges as $conyuge)
                  <tr>
                    <td>{{$conyuge->id}}</td>
                    <td>{{$conyuge->rut}}</td>
                    <td>{{$conyuge->nombre}}</td>
                    <td>{{$conyuge->fechaNacimiento}}</td>
                    <td>{{$conyuge->edad}}
                    <td>{{$conyuge->updated_at}}</td>
                    <td>

                    <div>
                    <a href="/conyuges/{{$conyuge->id}}" class="btn btn-success">Editar</a>  
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$conyuge->id}}">x</button>     
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



@foreach( $conyuges as $conyuge  )
<div id="myModal{{$conyuge->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Advertencia de Eliminacion</h4>
       
      </div>
      <div class="modal-body">
        <p> Esta seguro de querer eliminar al registro:{{$conyuge->nombre}}?</p>
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