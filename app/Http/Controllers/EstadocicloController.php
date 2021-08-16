<?php

namespace App\Http\Controllers;

use App\Models\Estadociclo;
use Illuminate\Http\Request;

class EstadocicloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $msgType = "";
        $msg = "";
        $estadociclos = Estadociclo::all()->sortByDesc("updated_at");
        return view("estadociclos.index",compact('estadociclos','msg','msgType'));
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
        $nombre = $request->input("nombre");

        $nombre_ = Estadociclo::where('nombre','=',$nombre)->get()->first();
        if( $nombre_ != null ) {
            $msg = "Estado:".$nombre." ya existe";
            $msgType = "warning";
            $estadociclos = Estadociclo::all()->sortByDesc("updated_at");
            return view("estadociclos.index",compact('estadociclos','msg','msgType'));
        }
       

        $estadociclo = new Estadociclo();
        $estadociclo->nombre = $nombre;
        $estadociclo->save();

        $msgType = "success";
        $msg = "Estado creado exitosamente";
        $estadociclos = Estadociclo::all()->sortByDesc("updated_at");;
        return view("estadociclos.index",compact('estadociclos','msg','msgType'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estadociclo  $estadociclo
     * @return \Illuminate\Http\Response
     */
    public function show(Estadociclo $estadociclo)
    {
        //
        $estadociclo  = Estadociclo::find( $estadociclo->id);
        $estadociclos = Estadociclo::all()->sortByDesc("updated_at");;
        return view('estadociclos.edit', compact('estadociclo','estadociclos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estadociclo  $estadociclo
     * @return \Illuminate\Http\Response
     */
    public function edit(Estadociclo $estadociclo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estadociclo  $estadociclo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estadociclo $estadociclo)
    {
        //
        $nombre = $request->input('nombre');
        $estadociclo = Estadociclo::find( $estadociclo->id);
        $estadociclo->save();

        $msgType = "success";
        $msg = "Estado actualizado exitosamente";
        $estadociclos = Estadociclo::all()->sortByDesc("updated_at");;
        return view("estadociclos.index",compact('estadociclos','msg','msgType'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estadociclo  $estadociclo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estadociclo $estadociclo)
    {
        //
        echo "Eliminando...";
        $estadociclo = Estadociclo::find($estadociclo->id);        
        $estadociclo->delete();

        $msgType = "success";
        $msg = "Estado eliminado exitosamente";
        $estadociclos = Estadociclo::all()->sortByDesc("updated_at");;
        return view("estadociclos.index",compact('estadociclos','msg','msgType'));
    }
}
