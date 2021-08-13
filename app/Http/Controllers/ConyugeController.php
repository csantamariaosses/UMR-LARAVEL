<?php

namespace App\Http\Controllers;

use App\Models\Conyuge;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ConyugeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $msg = "";
        $conyuges = Conyuge::all()->sortByDesc("updated_at");
        
        return view("conyuges.index",compact('conyuges','msg'));
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
        $msg = "";
        $rutC    = $request->input("rutConyuge");
        $nombreC = $request->input("nombreConyuge");
        $direccionC = $request->input("direccionConyuge");
        $emailC = $request->input("emailConyuge");
        $telefonoC = $request->input("telefonoConyuge");
        $fechaNacC = $request->input("fechaNacConyuge");
        $observacionesC = $request->input("observacionesConyuge");
        $antecMorbidosC = $request->input("antecMorbConyuge");


        if( $rutC == null ) { $rutC = ""; }
        if( $nombreC == null ) { $nombreC = ""; }
        if( $direccionC == null ) { $direccionC = ""; }
        if( $emailC == null ) { $emailC = ""; }
        if( $telefonoC == null ) { $telefonoC = ""; }
        if( $fechaNacC == null ) { $fechaNacC = ""; }
        if( $antecMorbidosC == null ) { $antecMorbidosC = ""; }
        if( $observacionesC == null ) { $observacionesC = ""; }

        $registro = Conyuge::where('rut', '=', $rutC)->get()->count();
        if( $registro > 0  ) {
            $msg =  $msg ."\nConyuge Ya Existe...!";
            $registros = Conyuge::all()->sortByDesc("updated_at");
            return view("conyuges.index",compact('registros', 'msg'));
        } else {
            $msg  = $msg . "Agregando conyuge...";
            //echo "FechaNac:" . $fechaNac;
            $registro = new Conyuge();
            $registro->rut = $rutC;
            $registro->nombre = $nombreC;
            $registro->direccion = $direccionC;
            $registro->email = $emailC;
            $registro->telefono = $telefonoC;
            $registro->fechaNacimiento = $fechaNacC;
            $registro->edad = Carbon::parse( $registro->fechaNacimiento)->age;
            $registro->antecedMorbidos = $antecMorbidosC;
            $registro->observaciones = $observacionesC;

            $registro->save();
            $conyuges = Conyuge::all()->sortByDesc("updated_at");
            $msg = $msg . "\nConyuge agregado exitosamente";
            return view("conyuges.index",compact('conyuges', 'msg'));
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conyuge  $conyuge
     * @return \Illuminate\Http\Response
     */
    public function show(Conyuge $conyuge)
    {
        //
        $conyuge  = Conyuge::find( $conyuge->id );
        $conyuges = Conyuge::all()->sortByDesc("updated_at");
        return view('conyuges.edit', compact('conyuge','conyuges'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conyuge  $conyuge
     * @return \Illuminate\Http\Response
     */
    public function edit(Conyuge $conyuge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conyuge  $conyuge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conyuge $conyuge)
    {
        //
        // DATOS CONYUGE
        $msg = "";
        $rut = $request->input('rutConyuge');
        $nombre = $request->input('nombreConyuge');
        $direccion = $request->input('direccionConyuge');
        $fechaNac = $request->input('fechaNacConyuge');
        $telefono = $request->input('telefonoConyuge');
        $email = $request->input('emailConyuge');
        $antecMorbidos = $request->input('antecMorbConyuge');
        $observaciones = $request->input('observacionesConyuge');

        if( $nombre == null ) { $nombre = ""; }
        if( $direccion == null ) { $direccion = ""; }
        if( $email == null ) { $email = ""; }
        if( $telefono == null ) { $telefono = ""; }
        if( $fechaNac == null ) { $fechaNac = ""; }
        if( $telefono == null ) { $telefono = ""; }
        if( $antecMorbidos == null ) { $antecMorbidos = ""; }
        if( $observaciones == null ) { $observaciones = ""; }

        $registro = Conyuge::find($conyuge->id)->first();
        $registro->rut = $rut;
        $registro->nombre = $nombre;
        $registro->direccion = $direccion;
        $registro->fechaNacimiento = $fechaNac;
        $registro->edad = Carbon::parse($registro->fechaNacimiento)->age;
        $registro->telefono = $telefono;
        $registro->email = $email;
        $registro->antecedMorbidos = $antecMorbidos;
        $registro->observaciones = $observaciones;

        $registro->save();

        $msg = $msg . "Paciente actualizado";
        $conyuges = Conyuge::all()->sortByDesc("updated_at");
        $conyuge   = Conyuge::find( $registro->id );
        return view("conyuges.index",compact('conyuges', 'msg'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conyuge  $conyuge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conyuge $conyuge)
    {
        //
        $conyuge = Conyuge::find($conyuge->id);        
        $conyuge->delete();
        $msg = "Eliminado exitosamente";
        $conyuges = Conyuge::all()->sortByDesc("updated_at");;
        return view("conyuges.index",compact('conyuges','msg'));
    }
}
