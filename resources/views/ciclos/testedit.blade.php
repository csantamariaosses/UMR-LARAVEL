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
             <form method="POST" action="/ciclos/{{$ciclo->id}}">
                 @method("PUT")
                 @csrf
                 <p><b>DATOS PACIENTE</b></p>  
                <table class="datosPaciente">
                     <tr><td align="right">Rut:&nbsp;</td><td><input type="text" name="rut"  id="rut" value="{{ $paciente->rut}}"></td></tr>
                     <tr><td align="right">Nombre:&nbsp;</td><td><input type="text" name="nombre"  id="nombre" size="60" value="{{ $paciente->nombre}}"></td></tr>
                     <tr><td align="right">Direccion:&nbsp;</td><td><input type="text" name="direccion"  id="direccion" size="60"  value="{{ $paciente->direccion}}"></td></tr>
                     <tr><td align="right">Email:&nbsp;</td><td><input type="email" name="email"  id="email" size="60"  value="{{ $paciente->email}}"></td></tr>
                     <tr><td align="right">Telefono:&nbsp;</td><td><input type="text" name="telefono"  id="telefono"  value="{{ $paciente->telefono}}"></td></tr>
                     <tr><td align="right">Fecha Nac.:&nbsp;</td><td><input type="date" name="fechaNac"  id="fechaNac"  value="{{ $paciente->fechaNacimiento}}">&nbsp;&nbsp;Edad:{{  $paciente->edad }}&nbsp;&nbsp;años</td></tr>
                     <tr><td align="right">Antec. Morbidos:&nbsp;</td><td><input type="text" name="antecMorb"  id="antecMorb" size="60"  value="{{ $paciente->antecedMorbidos}}"></td></tr>
                     <tr><td align="right">Diagnóstico:&nbsp;</td><td><input type="text" name="diagnostico"  id="diagnostico" size="60"  value="{{ $paciente->diagnostico}}"></td></tr>                     
                     <tr><td align="right">Observaciones:&nbsp;</td><td><textarea name="observaciones" cols="60" rows="3"> {{ $paciente->observaciones}}</textarea></td></tr>
                </table>        
                <br>         
                <p><b>DATOS CONYUGE</b></p>  
                <table class="datosPaciente">
                     <tr><td align="right">Rut:&nbsp;</td><td><input type="text" name="rutConyuge"  id="rutConyuge" value="{{ $conyuge->rut}}"></td></tr>
                     <tr><td align="right">Nombre:&nbsp;</td><td><input type="text" name="nombreConyuge"  id="nombreConyuge" size="60" value="{{ $conyuge->nombre}}"></td></tr>
                     <tr><td align="right">Direccion:&nbsp;</td><td><input type="text" name="direccionConyuge"  id="direccionConyuge" size="60"  value="{{ $conyuge->direccion}}"></td></tr>
                     <tr><td align="right">Email:&nbsp;</td><td><input type="email" name="emailConyuge"  id="emailConyuge" size="60"  value="{{ $conyuge->email}}"></td></tr>
                     <tr><td align="right">Telefono:&nbsp;</td><td><input type="text" name="telefonoConyuge"  id="telefonoConyuge"  value="{{ $conyuge->telefono}}"></td></tr>
                     <tr><td align="right">Fecha Nac.:&nbsp;</td><td><input type="date" name="fechaNacConyuge"  id="fechaNacConyuge"  value="{{ $conyuge->fechaNacimiento}}">&nbsp;&nbsp;Edad:{{  $conyuge->edad }}&nbsp;&nbsp;años</td></tr>
                     <tr><td align="right">Antec. Morbidos:&nbsp;</td><td><input type="text" name="antecMorbConyuge"  id="antecMorbConyuge" size="60"  value="{{ $conyuge->antecedMorbidos}}"></td></tr>
                     <tr><td align="right">Observaciones:&nbsp;</td><td><textarea name="observacionesConyuge" cols="60" rows="3"> {{ $conyuge->observaciones}}</textarea></td></tr>
                </table>
                <hr>
                <p><b>MEDICO</b></p>

                    {{$ciclo->rutMedico}}
                    <select name="medico">
                        <option value="0" selected>Seleccione...</option>
                        @foreach ($medicos as $key => $value)
                            <option value="{{ $value->rut }}" {{ $value->rut == $ciclo->rutMedico? 'selected':''}}>{{ $value->nombre }}</option>
                        @endforeach
                    </select>

                <br><br>
                <p><b>EXAMENES PABELLON</b></p>
                <table width="100%">
                    <tr><td><input type="checkbox" 
                          name="culdosentesis" 
                          value="1"  
                          {{ $ciclo->culdosentesis == 1 ? 'checked' : '' }}

                    > Culdosentesis</td><td>Fecha: <input type="date" name="fechaCuldosentesis"  id="fechaCuldosentesis" value="{{ $ciclo->fechaCuldosentesis}}"></td></tr>
                    <tr><td><input type="checkbox" 
                          name="transferencia" 
                          value="1"  
                          {{ $ciclo->transferencia == 1 ? 'checked' : '' }}

                    > Transferencia Embrionaria</td><td>Fecha: <input type="date" name="fechaTransferencia"  id="fechaTransfeencia" value="{{ $ciclo->fechaTransferencia}}"></td></tr>
                </table>

               

                <br><br>
                <p><b>BETA POSITIVO-NEGATIVO</b></p>
                <input type="text" name="BetaPositivo"  id="BetaPositivo" value="{{ $ciclo->betaPositivo}}">                
                <input type="text" name="BetaNegativo"  id="BetaNegativo" value="{{ $ciclo->betaNegativo}}">                

                <br><br>
                <p><b>PROCEDIMIENTOS LABORATORIO</b></p>

                @foreach($procedLabs as $procedLab )
                <p><input type="checkbox" 
                          name="{{ $procedLab->codigo }}"
                          value="{{ $procedLab->nombre }}"
                          {{ Str::of( $ciclo->codProcedimientos)->contains( $procedLab->codigo)? 'checked':''}}
                          > {{ $procedLab->nombre}}</p>               
                @endforeach

                <br>
                <p><b>ACO</b></p>
                <input type="text" name="aco" id="aco" value="{{ $ciclo->aco}}" size="60">
         
                <br><br>
                <p><b>REGLA</b></p>
                <input type="date" name="fechaRegla" id="fechaRegla" value="{{ $ciclo->fechaRegla}}"  size="60">

                <br><br>
                <p><b>HGC</b></p>
                <input type="text" name="hgc" id="hgc" value="{{ $ciclo->hgc}}"  size="10">

                <br><br>
                <p><b>RESULTADO BETA HGC</b></p>
                <input type="text" name="resultadoBetaHGC" id="resultadoBetaHGC" value="{{ $ciclo->resultadoBetaHgc}}"  size="10">

                <br><br>
                <p><b>RESULTADO FECUNDACION</b></p>
                <input type="text" name="resultadoFecund" id="resultadoFecund" value="{{ $ciclo->resultadoFecund}}"  size="60">

                <br><br>
                <p><b>OBSERVACIONES</b></p>
                <textarea name="observacionesCiclo" cols="60" rows="2">{{ $ciclo->observacionesCiclo}}</textarea>


                <BR>
                <table class="datosPaciente">
                <tr><td></td><td><button type="submit" class="btn btn-secondary">Guardar</button><a class="btn btn-primary" href="{{route('ciclos.index')}}" role="button">Cancelar</a></td></tr>
                </tablel>

            </form>
        </div>
        <div class="col-sm-6">
            
        </div>
    </div>
</div>
 <HR> 
@stop