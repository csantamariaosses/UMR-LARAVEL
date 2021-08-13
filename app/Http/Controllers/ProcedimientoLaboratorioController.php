<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procedimientolaboratorio;

class ProcedimientoLaboratorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $procedLabs = Procedimientolaboratorio::all()->sortByDesc("updated_at");
        return view("procedimientoLaboratorio.index",compact('procedLabs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $codigo = $request->input("codigo");
        $nombre = $request->input("nombre");
        $precio = $request->input("precio");

        
        $registro = Procedimientolaboratorio::where('codigo', '=', $codigo)->first();
        if( $registro != null  ) {
            $msg = "Ya se encuentra";
        } else {

            if( $precio == null ) { $precio = "0"; }

            $proced = new Procedimientolaboratorio();
            $proced->codigo = $codigo;
            $proced->nombre = $nombre;
            $proced->precio = $precio;
            $proced->save();
            
        }
        $procedLabs = Procedimientolaboratorio::all()->sortByDesc("updated_at");;
        return view("procedimientoLaboratorio.index",compact('procedLabs'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $procedLab = Procedimientolaboratorio::find($id);
        $procedLabs = Procedimientolaboratorio::all()->sortByDesc("updated_at");;
        return view('procedimientoLaboratorio.edit', compact('procedLab','procedLabs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, $id)
    {

        $codigo = $request->input('codigo');
        $nombre = $request->input('nombre');
        $precio = $request->input('precio');

        $registro = Procedimientolaboratorio::find($id);
        $registro->codigo = $codigo;
        $registro->nombre = $request->input('nombre');
        $registro->precio = $precio;
        $registro->save();

        $procedLabs = Procedimientolaboratorio::all()->sortByDesc("updated_at");;
        return view("procedimientolaboratorio.index",compact('procedLabs'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ) {

        $proced = Procedimientolaboratorio::find($id);        
        $proced->delete();

        $procedLabs = Procedimientolaboratorio::all()->sortByDesc("updated_at");;
        return view("procedimientoLaboratorio.index",compact('procedLabs'));
    }
}
