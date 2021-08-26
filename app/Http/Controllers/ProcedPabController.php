<?php

namespace App\Http\Controllers;

use App\Models\ProcedPab;
use Illuminate\Http\Request;

class ProcedPabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $procedPabs = ProcedPab::all()->sortByDesc("updated_at");
        return view("procedPabs.index",compact('procedPabs'));
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

        
        $registro = ProcedPab::where('codigo', '=', $codigo)->first();
        if( $registro != null  ) {
            $msg = "Ya se encuentra";
        } else {

            if( $precio == null ) { $precio = "0"; }

            $proced = new ProcedPab();
            $proced->codigo = $codigo;
            $proced->nombre = $nombre;
            $proced->precio = $precio;
            $proced->save();
            
        }
        
        $procedPabs = ProcedPab::all()->sortByDesc("updated_at");;
        $msg = "Registro agregado...";
        return view("procedPabs.index",compact('procedPabs','msg'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcedPab  $procedPab
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        //
        $procedPab  = ProcedPab::find($id);
        $procedPabs = ProcedPab::all()->sortByDesc("updated_at");
        $msg = "";
        return view('procedPabs.edit', compact('procedPab','procedPabs','msg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProcedPab  $procedPab
     * @return \Illuminate\Http\Response
     */
    public function edit(ProcedPab $procedPab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProcedPab  $procedPab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProcedPab $procedPab)
    {

        $codigo = $request->input('codigo');
        $nombre = $request->input('nombre');
        $precio = $request->input('precio');

        $registro = ProcedPab::find($procedPab)->first();
        $registro->codigo = $codigo;
        $registro->nombre = $nombre;
        $registro->precio = $precio;
        $registro->save();

        $msg = "Registro actualizado...";
        $procedPabs = ProcedPab::all()->sortByDesc("updated_at");;
        return view("procedPabs.index",compact('procedPabs','msg'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcedPab  $procedPab
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcedPab $procedPab)
    {
        //
        $proced = ProcedPab::find($procedPab)->first();        
        $proced->delete();

        $msg = "Registro eliminado...";
        $procedPabs = ProcedPab::all()->sortByDesc("updated_at");;
        return view("procedPabs.index",compact('procedPabs','msg'));
    }
}
