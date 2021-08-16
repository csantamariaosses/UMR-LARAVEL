@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
          <h4>CICLOS - <span class="verde">EDITAR</span></h4>
        </div>
    </div>
    <hr>
    <div class="row mt-4">
        <div class="col-sm-6">
             <form method="POST" action="/ciclo2s/{{$ciclo2->id}}">
                 @method("PUT")
                 @csrf
                 <p><b>DATOS PACIENTE</b></p>  
                <table class="datosPaciente">
                     <tr><td align="right">ID. CICLO:&nbsp;</td><td><input type="text" name="idCiclo"  id="idCiclo" value="{{ $ciclo2->id}}" disabled></td></tr>
                     <tr><td align="right">Rut:&nbsp;</td><td><input type="text" name="rut"  id="rut" value="{{ $ciclo2->paciente->rut}}"></td></tr>
                     <tr><td align="right">Nombre:&nbsp;</td><td><input type="text" name="nombre"  id="nombre" size="60" value="{{ $ciclo2->paciente->nombre}}"></td></tr>
                     <tr><td align="right">Direccion:&nbsp;</td><td><input type="text" name="direccion"  id="direccion" size="60"  value="{{ $ciclo2->paciente->direccion}}"></td></tr>
                     <tr><td align="right">Email:&nbsp;</td><td><input type="email" name="email"  id="email" size="60"  value="{{ $ciclo2->paciente->email}}"></td></tr>
                     <tr><td align="right">Telefono:&nbsp;</td><td><input type="text" name="telefono"  id="telefono"  value="{{ $ciclo2->paciente->telefono}}"></td></tr>
                     <tr><td align="right">Fecha Nac.:&nbsp;</td><td><input type="date" name="fechaNac"  id="fechaNac"  value="{{ $ciclo2->paciente->fechaNacimiento}}">&nbsp;&nbsp;Edad:{{  $ciclo2->paciente->edad }}&nbsp;&nbsp;años</td></tr>
                     <tr><td align="right">Antec. Morbidos:&nbsp;</td><td><input type="text" name="antecMorb"  id="antecMorb" size="60"  value="{{ $ciclo2->paciente->antecedMorbidos}}"></td></tr>
                     <tr><td align="right">Diagnóstico:&nbsp;</td><td><input type="text" name="diagnostico"  id="diagnostico" size="60"  value="{{ $ciclo2->paciente->diagnostico}}"></td></tr>                     
                     <tr><td align="right">Observaciones:&nbsp;</td><td><textarea name="observaciones" cols="60" rows="3"> {{ $ciclo2->paciente->observaciones}}</textarea></td></tr>
                </table>        
                <br>         
                <p><b>DATOS CONYUGE</b></p>
                @if( is_null( $ciclo2->conyuge) ) 
                <table class="datosPaciente">
                     <tr><td align="right">Rut:&nbsp;</td><td><input 
                                    type="text" 
                                    name="rutConyuge"  
                                    id="rutConyuge" 
                                    value="">
                        </td></tr>
                     <tr><td align="right">Nombre:&nbsp;</td><td><input 
                                    type="text" 
                                    name="nombreConyuge"  
                                    id="nombreConyuge" 
                                    size="60" 
                                    value="">
                        </td></tr>
                     <tr><td align="right">Direccion:&nbsp;</td><td><input 
                                    type="text" 
                                    name="direccionConyuge"  
                                    id="direccionConyuge" 
                                    size="60"  
                                    value="">
                                </td></tr>
                     <tr><td align="right">Email:&nbsp;</td><td><input 
                                    type="email" 
                                    name="emailConyuge"  
                                    id="emailConyuge" 
                                    size="60"  
                                    value="">
                                </td></tr>
                     <tr><td align="right">Telefono:&nbsp;</td><td><input 
                                    type="text" 
                                    name="telefonoConyuge"  
                                    id="telefonoConyuge"  
                                    value="">
                                </td></tr>
                     <tr><td align="right">Fecha Nac.:&nbsp;</td><td><input 
                                    type="date" 
                                    name="fechaNacConyuge"  
                                    id="fechaNacConyuge"  
                                    value="">
                                </td></tr>
                     <tr><td align="right">Antec. Morbidos:&nbsp;</td><td><input 
                                    type="text" 
                                    name="antecMorbConyuge"  
                                    id="antecMorbConyuge" 
                                    size="60"  
                                    value="">
                                </td></tr>
                     <tr><td align="right">Observaciones:&nbsp;</td><td><textarea name="observacionesConyuge" cols="60" rows="3"></textarea>
                                </td></tr>
                </table>
                @else
                <table class="datosPaciente">
                     <tr><td align="right">Rut:&nbsp;</td><td><input 
                                    type="text" 
                                    name="rutConyuge"  
                                    id="rutConyuge" 
                                    value="{{ $ciclo2->conyuge->rut}}">
                        </td></tr>
                     <tr><td align="right">Nombre:&nbsp;</td><td><input 
                                    type="text" 
                                    name="nombreConyuge"  
                                    id="nombreConyuge" 
                                    size="60" 
                                    value="{{ $ciclo2->conyuge->nombre}}">
                        </td></tr>
                     <tr><td align="right">Direccion:&nbsp;</td><td><input 
                                    type="text" 
                                    name="direccionConyuge"  
                                    id="direccionConyuge" 
                                    size="60"  
                                    value="{{ $ciclo2->conyuge->direccion}}">
                                </td></tr>
                     <tr><td align="right">Email:&nbsp;</td><td><input 
                                    type="email" 
                                    name="emailConyuge"  
                                    id="emailConyuge" 
                                    size="60"  
                                    value="{{ $ciclo2->conyuge->email}}">
                                </td></tr>
                     <tr><td align="right">Telefono:&nbsp;</td><td><input 
                                    type="text" 
                                    name="telefonoConyuge"  
                                    id="telefonoConyuge"  
                                    value="{{$ciclo2->conyuge->telefono}}">
                                </td></tr>
                     <tr><td align="right">Fecha Nac.:&nbsp;</td><td><input 
                                    type="date" 
                                    name="fechaNacConyuge"  
                                    id="fechaNacConyuge"  
                                    value="{{ $ciclo2->conyuge->fechaNacimiento}}">
                                </td></tr>
                     <tr><td align="right">Antec. Morbidos:&nbsp;</td><td><input 
                                    type="text" 
                                    name="antecMorbConyuge"  
                                    id="antecMorbConyuge" 
                                    size="60"  
                                    value="{{ $ciclo2->conyuge->antecedMorbidos}}">
                                </td></tr>
                     <tr><td align="right">Observaciones:&nbsp;</td><td><textarea name="observacionesConyuge" cols="60" rows="3"> {{$ciclo2->conyuge->observaciones}}"</textarea>
                                </td></tr>
                </table>

                @endif

                <hr>
                <p><b>MEDICO</b></p>

                    @if(is_null( $ciclo2->medico) )
                    <select name="medico">
                        <option value="0" selected>Seleccione...</option>
                        @foreach ($medicos as $medico )                                                    
                            <option value="{{ $medico->id }}"> {{ $medico->nombre }}</option>
                        @endforeach
                    </select>                    
                    @else
                    <select name="medico">
                        <option value="0" selected>Seleccione...</option>
                        @foreach ($medicos as $key => $value)
                                                    
                            <option value="{{ $value->id }}" {{ $value->id == $ciclo2->medico->id? 'selected':''}}>{{ $value->nombre }}</option>
                        @endforeach
                    </select>

                    @endif
                    

                <br><br>
                <p><b>EXAMENES PABELLON</b></p>
                <table width="100%">
                    <tr><td><input type="checkbox" 
                          name="culdosentesis" 
                          value="1"  
                          {{ $ciclo2->culdosentesis == 1 ? 'checked' : '' }}

                    > Culdosentesis</td><td>Fecha: <input type="date" name="fechaCuldosentesis"  id="fechaCuldosentesis" value="{{ $ciclo2->fechaCuldosentesis}}"></td></tr>
                    <tr><td><input type="checkbox" 
                          name="transferencia" 
                          value="1"  
                          {{ $ciclo2->transferencia == 1 ? 'checked' : '' }}

                    > Transferencia Embrionaria</td><td>Fecha: <input type="date" name="fechaTransferencia"  id="fechaTransfeencia" value="{{ $ciclo2->fechaTransferencia}}"></td></tr>
                </table>

               

                <br><br>
                <p><b>BETA POSITIVO-NEGATIVO</b></p>
                <div>
                <table width="100%">
                  <tr><td><input type="radio" id="beta" name="beta" value="1" {{ $ciclo2->betaPositivo == 1 ? 'checked' : '' }}> Beta Positivo</td><td>&nbsp;&nbsp;Fecha:<input type="date" name="fechaBeta"  name="fechaBeta" value="{{ $ciclo2->fechaBeta}}"></td></tr>
                  <tr><td><input type="radio" id="beta" name="beta" value="0" {{ $ciclo2->betaNegativo == 1 ? 'checked' : '' }}> Beta Negativo</td><td></td></tr>
                </table>
                </div>
    

                <br><br>
                <p><b>PROCEDIMIENTOS LABORATORIO</b></p>

                @foreach($procedLabs as $procedLab )
                <p><input type="checkbox" 
                          name="{{ $procedLab->codigo }}"
                          value="{{ $procedLab->nombre }}"
                          {{ Str::of( $ciclo2->codProcedimientos)->contains( $procedLab->codigo)? 'checked':''}}
                          > {{ $procedLab->nombre}}</p>               
                @endforeach

                <br>
                <p><b>ACO</b></p>
                <input type="text" name="aco" id="aco" value="{{ $ciclo2->aco}}" size="60">
         
                <br><br>
                <p><b>REGLA</b></p>
                <input type="date" name="fechaRegla" id="fechaRegla" value="{{ $ciclo2->fechaRegla}}"  size="60">

                <br><br>
                <p><b>HGC</b></p>
                <input type="text" name="hgc" id="hgc" value="{{ $ciclo2->hgc}}"  size="10">

                <br><br>
                <p><b>RESULTADO BETA HGC</b></p>
                <input type="text" name="resultadoBetaHGC" id="resultadoBetaHGC" value="{{ $ciclo2->resultadoBetaHgc}}"  size="10">

                <br><br>
                <p><b>RESULTADO FECUNDACION</b></p>
                <input type="text" name="resultadoFecund" id="resultadoFecund" value="{{ $ciclo2->resultadoFecund}}"  size="60">

                <br><br>
                <p><b>ESTADO CICLO</b></p>
                <select name="estadociclo">
                        <option value="0" selected>Seleccione...</option>
                        @foreach ($estadociclos as $key => $value)
                                                    
                            <option value="{{ $value->id }}" {{ $value->id == $ciclo2->estadociclo->id? 'selected':''}}>{{ $value->nombre }}</option>
                        @endforeach
                </select>

                <br><br>
                <p><b>OBSERVACIONES</b></p>
                <textarea name="observacionesCiclo" cols="60" rows="2">{{ $ciclo2->observaciones}}</textarea>


                <BR>
                <table class="datosPaciente">
                <tr><td></td><td><button type="submit" class="btn btn-secondary">Guardar</button><a class="btn btn-primary" href="{{route('ciclo2s.index')}}" role="button">Cancelar</a></td></tr>
                </tablel>

            </form>
        </div>
        <div class="col-sm-6">
            
        </div>
    </div>
</div>
 <HR> 
@stop