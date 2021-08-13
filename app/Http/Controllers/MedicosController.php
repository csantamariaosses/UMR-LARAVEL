<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;

class MedicosController extends Controller
{
    public function index() {
        $medicos = Medico::all()->sortByDesc("updated_at");
        return view("medicos.index",compact('medicos'));
    }
    

    public function store(Request $request) {
        $rut    = $request->input("rut");
        $nombre = $request->input("nombre");
        $especialidad = $request->input("especialidad");

        if( $rut == null ) { $rut = ""; }
        if( $especialidad == null ) { $especialidad = ""; }

        $medico = new Medico();
        $medico->rut = $rut;
        $medico->nombre = $nombre;
        $medico->especialidad = $especialidad;
        $medico->save();

        $medicos = Medico::all()->sortByDesc("updated_at");;
        return view("medicos.index",compact('medicos'));
    }


    public function destroy( $id ) {

        echo "Eliminando...";
        $medico = Medico::find($id);        
        $medico->delete();

        $medicos = Medico::all()->sortByDesc("updated_at");;
        return view("medicos.index",compact('medicos'));
    }

    public function edit($id)
    {
         $medico = Medico::find($id);
         return view('medicos.edit')->with('medico',$medico);
    }

    public function show($id)
    {
        //

        $medico = Medico::find($id);
        $medicos = Medico::all()->sortByDesc("updated_at");;
        return view('medicos.edit', compact('medico','medicos'));
    }

    public function update(Request $request, $id)
    {

        $rut = $request->input('rut');
        $especialidad = $request->input('especialidad');

        if( $rut == null ) { $rut = ""; }
        if( $especialidad == null ) { $especialidad = ""; }

        $medico = Medico::find($id);
        $medico->rut = $rut;
        $medico->nombre = $request->input('nombre');
        $medico->especialidad = $especialidad;
        $medico->save();

        $medicos = Medico::all()->sortByDesc("updated_at");;
        return view("medicos.index",compact('medicos'));
    }


}
