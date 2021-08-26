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
        
             <form method="POST" action="/pacientes/{{$paciente->id}}">
                 @method("PUT")
                 @csrf
                 <div class="col-sm-6">
                 <p>DATOS PACIENTE</p>
                 <table class="datosPaciente">
                     <tr><td align="right">Rut:&nbsp;</td><td><input type="text" name="rut"  id="rut" value="{{ $paciente->rut}}">&nbsp;&nbsp;</td></tr>
                     <tr><td align="right">Nombre:&nbsp;</td><td><input type="text" name="nombre"  id="nombre" size="40"  value="{{ $paciente->nombre}}"></td></tr>
                     <tr><td align="right">Direccion:&nbsp;</td><td><input type="text" name="direccion"  id="direccion" size="40"  value="{{ $paciente->direccion}}"></td></tr>
                     <tr><td align="right">Email:&nbsp;</td><td><input type="email" name="email"  id="email" size="40"  value="{{ $paciente->email}}"></td></tr>
                     <tr><td align="right">Telefono:&nbsp;</td><td><input type="text" name="telefono"  id="telefono"  value="{{ $paciente->telefono}}"></td></tr>
                     <tr><td align="right">Fecha Nac.:&nbsp;</td><td><input type="date" name="fechaNac"  id="fechaNac"  value="{{ $paciente->fechaNacimiento}}">&nbsp;&nbsp;Edad:{{  $paciente->edad }}&nbsp;&nbsp;años</td></tr>
                     <tr><td align="right">Diagnóstico:&nbsp;</td><td><textarea name="diagnostico" cols="40" rows="2">{{$paciente->diagnostico}}</textarea> </td></tr>
                     <tr><td align="right">Observaciones:&nbsp;</td><td><textarea name="observaciones" cols="40" rows="3">{{ $paciente->observaciones}}</textarea> </td></tr>
                     
                </table>
              </div>
            
                <div class="col-sm-6">
                <p>DATOS CONYUGE</p>  
                <table class="datosPaciente">
                     <tr><td align="right">Rut:&nbsp;</td><td><input type="text" name="rutConyuge"  id="rutConyuge" value="{{ $conyuge->rut}}"></td></tr>
                     <tr><td align="right">Nombre:&nbsp;</td><td><input type="text" name="nombreConyuge"  id="nombreConyuge" size="40" value="{{ $conyuge->nombre}}"></td></tr>
                     <tr><td align="right">Direccion:&nbsp;</td><td><input type="text" name="direccionConyuge"  id="direccionConyuge" size="40"  value="{{ $conyuge->direccion}}"></td></tr>
                     <tr><td align="right">Email:&nbsp;</td><td><input type="email" name="emailConyuge"  id="emailConyuge" size="40"  value="{{ $conyuge->email}}"></td></tr>
                     <tr><td align="right">Telefono:&nbsp;</td><td><input type="text" name="telefonoConyuge"  id="telefonoConyuge"  value="{{ $conyuge->telefono}}"></td></tr>
                     <tr><td align="right">Fecha Nac.:&nbsp;</td><td><input type="date" name="fechaNacConyuge"  id="fechaNacConyuge"  value="{{ $conyuge->fechaNacimiento}}">&nbsp;&nbsp;Edad:{{  $conyuge->edad }}&nbsp;&nbsp;años</td></tr>
                     <tr><td align="right">Antec. Morbidos:&nbsp;</td><td><input type="text" name="antecMorbConyuge"  id="antecMorbConyuge" size="40"  value="{{ $conyuge->antecedMorbidos}}"></td></tr>
                     <tr><td align="right">Observaciones:&nbsp;</td><td><textarea name="observacionesConyuge" cols="40" rows="3"> {{ $conyuge->observaciones}}</textarea></td></tr>
                     <tr><td></td><td><a class="btn btn-primary" href="{{route('pacientes.index')}}" role="button">Cancelar</a><button type="submit" class="btn btn-secondary">Guardar</button></td></tr>
                </table>
              </div>
            </form>
        </div>
    </div>
</div>
 <HR> 

@stop