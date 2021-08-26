@extends('layouts.layout')
@section("css")
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css"/>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
           <h4>LISTADO - CICLOS</h4>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
        <div class="alert alert-danger">{{$msg}}</div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
        <div><b>Regla</b></div>
        </div>
        <div class="col-sm-3">
        <div><b>Estado Ciclo</b></div>
        </div>
        <div class="col-sm-3">
        <div><b>Procedimiento</b></div>
        </div>
        <div class="col-sm-3">
        
        </div>
    </div>

        
       
             <form method="POST" action="/ciclosListado">
                <div class="row mt-3">    
                 @csrf
                    <div class="col-sm-3">
                         <table>
                         <tr><td align="right">Fecha Desde:&nbsp;</td><td><input type="date" name="fechaDesde"  id="fechaDesde"></td></tr>
                         <tr><td align="right">Fecha Hasta:&nbsp;</td><td><input type="date" name="fechaHasta"  id="fechaHasta"></td></tr>                     
                         </table>
                    </div>
                    <div class="col-sm-3">
                        <table>
                            <tr><td align="right">Estado::&nbsp;</td><td>
                            <select name="estadociclo">
                                <option value="0" selected>Seleccione...</option>
                                @foreach ($estadociclos as $key => $value)
                                                            
                                    <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                                @endforeach
                            </select>     
                                </td>
                            </tr>                    
                        </table>
                    </div>  
                    <div class="col-sm-3">
                        <table>
                            <tr><td align="right">Proced.Pab:&nbsp;</td><td>
                                <select name="procedimientoPab">
                                    <option value="0" selected>Seleccione...</option>
                                    @foreach ($procedimientoPabs as $key => $value)                                                    
                                        <option value="{{ $value->codigo }}">{{ $value->nombre }}</option>
                                    @endforeach
                                </select>     
                            </td></tr>
                        </table>
                    </div>
                    <div class="col-sm-3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                       <button type="submit" class="btn btn-secondary">Buscar</button>
                    </div>
                </div>


            </form>
        
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
                <table id="ciclos" class="table table-dark table-striped mt-4  listadoCiclos">    
                    <thead>
                    <tr>  <th>Acción</th>
                        <th>Id</th>
                        <th>Estado</th>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Fecha.Nac</th>
                        <th>Edad</th>
                        <th>Medico</th>
                        <th>Regla</th>  
                        <th>FechaHoraHCG</th>
                        <th>FechaHoraPabellon</th>
                  
                        <th>Culdo</th>
                        <th>Transf</th>
                        <th>FechaTransf</th>
                        <th>ProcedLabs</th>
                        <th>Beta</th>
                        <th>FechaBeta</th>
                        <th>ACO</th>
                        <th>Acción</th>                         
                       
                    </tr>
                    </thead>
                    <tbody>
                @foreach($ciclo2s as $ciclo2 )
                <tr>
                    <td><a href="/ciclo2s/{{$ciclo2->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Editar</a>  </td>
                    <td>{{ $ciclo2->id}}</td>
                    <td>{{ $ciclo2->estadociclo->nombre }}</td>
                    <td>{{ $ciclo2->paciente->rut }}</td>
                    <td>{{ $ciclo2->paciente->nombre }}</td>
                    <td>{{ $ciclo2->paciente->fechaNacimiento }}</td>
                    <td>{{ $ciclo2->paciente->edad }}</td>                    
                    <td>@if( $ciclo2->medico != null ) {{strtok($ciclo2->medico->nombre," " )}}  @else '' @endif</td>
                    <td class="regla">{{ $ciclo2->fechaRegla}}</td>
                    <td>{{ $ciclo2->fechaHoraHCG}}</td>
                    <td>{{ $ciclo2->fechaHoraPabellon}}</td>
                    <td>{{ $ciclo2->culdosentesis}}</td>
                    <td>{{ $ciclo2->transferencia}}</td>
                    <td>{{ $ciclo2->fechaTransferencia}}</td>
                    <td>{{ $ciclo2->procedimientos}}</td>
                    <td>{{ $ciclo2->betaPositivo}}</td>
                    <td>{{ $ciclo2->fechaBeta}}</td>
                    <td>{{ $ciclo2->aco}}</td>
                  
                    <td>
                     <div>
                    <a href="/ciclo2s/{{$ciclo2->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Editar</a>  
                    <button type="button" class="btn btn-danger botonEliminar" data-toggle="modal" data-target="#myModal{{$ciclo2->id}}"></button>     
                    </div>
                    </td></tr>

                @endforeach
                </tbody> 
                </table>
            @else
                <br><h4>No Existen Registros Que Mostrar</h4>
            @endif
        </div>
</div>


@foreach( $ciclo2s as $ciclo2  )
<div id="myModal{{$ciclo2->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Advertencia de Eliminacion</h4>
       
      </div>
      <div class="modal-body">
        <p> Esta seguro de querer eliminar al registro:{{$ciclo2->nombre}}?</p>
      </div>
      <div class="modal-footer">
        <form action="{{ route('ciclo2s.destroy',$ciclo2->id) }}" method="POST">                             
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
    $('#ciclos').DataTable(
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
@stop

