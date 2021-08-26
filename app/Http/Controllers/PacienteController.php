<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Conyuge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PacienteController extends Controller
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
        $pacientes = Paciente::all()->sortByDesc("updated_at");
        $conteo = count( $pacientes );
        return view("pacientes.index",compact('pacientes','msg'));
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
        //echo "Store";
        $rut    = $request->input("rut");
        $nombre = $request->input("nombre");
        $direccion = $request->input("direccion");
        $email = $request->input("email");
        $telefono = $request->input("telefono");
        $fechaNac = $request->input("fechaNac");
        $diagnostico = $request->input("diagnostico");
        $antecedMorbidos = $request->input("antecedMorbidos");
        $observaciones = $request->input("observaciones");


        $rutConyuge = $request->input("rutConyuge");
        $rutC    = $request->input("rutConyuge");
        $nombreC = $request->input("nombreConyuge");
        $direccionC = $request->input("direccionConyuge");
        $emailC = $request->input("emailConyuge");
        $telefonoC = $request->input("telefonoConyuge");
        $fechaNacC = $request->input("fechaNacConyuge");
        $observacionesC = $request->input("observacionesConyuge");


        $msg = "";

        if( $rut == null ) { $rut = ""; }
        if( $nombre == null ) { $nombre = ""; }
        if( $direccion == null ) { $direccion = ""; }
        if( $email == null ) { $email = ""; }
        if( $telefono == null ) { $telefono = ""; }
        if( $fechaNac == null ) { $fechaNac = ""; }
        if( $rutConyuge == null ) { $rutConyuge = ""; }
        if( $diagnostico == null ) { $diagnostico = ""; }
        if( $antecedMorbidos == null ) { $antecedMorbidos = ""; }
        if( $observaciones == null ) { $observaciones = ""; }


        if( $rutC == null ) { $rutC = ""; }
        if( $nombreC == null ) { $nombreC = ""; }
        if( $direccionC == null ) { $direccionC = ""; }
        if( $emailC == null ) { $emailC = ""; }
        if( $observacionesC == null ) { $observacionesC = ""; }

        //$id = DB::table('pacientes')->select('id')->where('rut', 'like', '%$rut%')->first();
        $paciente = Paciente::where('rut', '=', $rut)->get()->count();
        //dd( $paciente );

        if( $paciente > 0  ) {
            $msg =  $msg ."\nPaciente Ya Existe... actualizando...!";
            
            $paciente = Paciente::where('rut', '=', $rut)->get()->first();
            //dd( $paciente->id);
            
            $registro = Paciente::find($paciente->id);
            $registro->rut = $rut;
            $registro->nombre = $nombre;
            $registro->direccion = $direccion;
            $registro->fechaNacimiento = $fechaNac;
            $registro->edad = Carbon::parse($registro->fechaNacimiento)->age;
            $registro->telefono = $telefono;
            $registro->email = $email;
            $registro->diagnostico = $diagnostico;
            $registro->observaciones = $observaciones;
            $registro->antecedMorbidos = $antecedMorbidos;
            $registro->rutConyuge = $rutC;

            $registro->save();

            $pacientes = Paciente::all()->sortByDesc("updated_at");
            return view("pacientes.index",compact('pacientes', 'msg'));
        } else {
            //echo "FechaNac:" . $fechaNac;
            $paciente = new Paciente();
            $paciente->rut = $rut;
            $paciente->nombre = $nombre;
            $paciente->direccion = $direccion;
            $paciente->email = $email;
            $paciente->telefono = $telefono;
            $paciente->fechaNacimiento = $fechaNac;
            $paciente->edad = Carbon::parse($paciente->fechaNacimiento)->age;
            $paciente->diagnostico = $diagnostico;
            $paciente->antecedMorbidos = $antecedMorbidos;
            $paciente->rutConyuge = $rutConyuge;
            $paciente->observaciones = $observaciones;

            $paciente->save();            
            $msg = $msg . "\nPaciente agregado exitosamente";

            if( $rutC != "") {
                $conyuge = Conyuge::where('rut', '=', $rutC)->get()->count();
                if( $conyuge > 0  ) {
                    $msg = $msg .  "\nConyuge Ya Existe...!";
                    $pacientes = Paciente::all()->sortByDesc("updated_at");
                    return view("pacientes.index",compact('pacientes', 'msg'));
                } else {
                    $conyuge = new Conyuge();
                    $conyuge->rut = $rutC;
                    $conyuge->nombre = $nombreC;
                    $conyuge->direccion = $direccionC;
                    $conyuge->email = $emailC;
                    $conyuge->telefono = $telefonoC;
                    $conyuge->fechaNacimiento = $fechaNacC;
                    $conyuge->edad = Carbon::parse($conyuge->fechaNacimiento)->age;
                    $conyuge->observaciones = $observacionesC;
        
                    $conyuge->save();
                    $pacientes = Paciente::all()->sortByDesc("updated_at");
                    $msg = $msg . "Conyuge agregado exitosamente";
                    return view("pacientes.index",compact('pacientes','msg'));
                }
            }   else {
                $pacientes = Paciente::all()->sortByDesc("updated_at");
                return view("pacientes.index",compact('pacientes', 'msg'));
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {
        //
        //echo "Paciente:" . $paciente;
        $paciente  = Paciente::find( $paciente->id );
        if( $paciente->rutConyuge == "") {
            $conyuge = new Conyuge();
            $conyuge->rut = "";
            $conyuge->nombre = "";
            $conyuge->direccion = "";
            $conyuge->email = "";
            $conyuge->telefono = "";
            $conyuge->fechaNacimiento = "";
            $conyuge->antecedMorbidos = "";
            $conyuge->observaciones = "";
            $pacientes = Paciente::all()->sortByDesc("updated_at");
            $msg = "";
            return view('pacientes.edit', compact('paciente','pacientes','conyuge', 'msg'));

        } else {
           // echo "<br>Busca dtaos del conyuge:" . $paciente->rutConyuge;
            $rutConyuge = $string = Str::of($paciente->rutConyuge)->trim();

            $conyuge_ = Conyuge::where("rut", "=", $rutConyuge)->get();
            //echo "<br>Conyuge ID::" . $conyuge_[0]->id;


            if( $conyuge_ == null) {
                //echo "No Encontrado";
                $conyuge = new Conyuge();
                $conyuge->rut =  $paciente->rutConyuge;
                $conyuge->nombreC = "";
                $conyuge->direccionC = "";
                $conyuge->emailC = "";
                $conyuge->telefonoC = "";
                $conyuge->fechaNacimientoC = "";
                $conyuge->observacionesC = "";
                $pacientes = Paciente::all()->sortByDesc("updated_at");
                $msg = "";
                return view('pacientes.edit', compact('paciente','pacientes','conyuge','msg'));
            } else {
                //echo "Encontrado";
                //echo "RUT:". $conyuge_[0]->rut;
                $conyuge = $conyuge_[0];
                $pacientes = Paciente::all()->sortByDesc("updated_at");
                $msg = "";
                return view('pacientes.edit', compact('paciente','pacientes','conyuge','msg'));
                
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit(Paciente $paciente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paciente $paciente)
    {
        //
        //echo  "uPDATE::" . $paciente;

        // DATOS PACIENTE
        $msg = "";
        $rut = $request->input('rut');
        $nombre = $request->input('nombre');
        $direccion = $request->input('direccion');
        $fechaNac = $request->input('fechaNac');
        $telefono = $request->input('telefono');
        $email = $request->input('email');
        $diagnostico = $request->input('diagnostico');
        $antecedMorbidos = $request->input('antecedMorbidos');
        $observaciones = $request->input('observaciones');
        $rutC = $request->input('rutConyuge');

        if( $direccion == null ) { $direccion = ""; }
        if( $email == null ) { $email = ""; }
        if( $telefono == null ) { $telefono = ""; }
        if( $fechaNac == null ) { $fechaNac = ""; }
        if( $telefono == null ) { $telefono = ""; }
        if( $antecedMorbidos == null ) { $antecedMorbidos = ""; }
        if( $observaciones == null ) { $observaciones = ""; }
        if( $rutC == null ) { $rutC = ""; }


        //echo "<br>fECHAnAC:" . $fechaNac;
        

        $registro = Paciente::find($paciente->id);
        $registro->rut = $rut;
        $registro->nombre = $nombre;
        $registro->direccion = $direccion;
        $registro->fechaNacimiento = $fechaNac;
        $registro->edad = Carbon::parse($registro->fechaNacimiento)->age;
        $registro->telefono = $telefono;
        $registro->email = $email;
        $registro->diagnostico = $diagnostico;
        $registro->observaciones = $observaciones;
        $registro->antecedMorbidos = $antecedMorbidos;
        $registro->rutConyuge = $rutC;

    

        $registro->save();

        $msg = $msg . "Paciente actualizado";


        // DATOS CONYUGE
        $rutC = $request->input('rutConyuge');
        $nombreC = $request->input('nombreConyuge');
        $direccionC = $request->input('direccionConyuge');
        $fechaNacC = $request->input('fechaNacConyuge');
        $telefonoC = $request->input('telefonoConyuge');
        $emailC = $request->input('emailConyuge');       
        $observacionesC = $request->input('observacionesConyuge');

        if( $rutC == null ) { $rutC = ""; }
        if( $nombreC == null ) { $nombreC = ""; }
        if( $direccionC == null ) { $direccionC = ""; }
        if( $emailC == null ) { $emailC = ""; }
        if( $telefonoC == null ) { $telefonoC = ""; }
        if( $fechaNacC == null ) { $fechaNacC = ""; }
        if( $antecMorbC == null ) { $antecMorbC = ""; }
        if( $observacionesC == null ) { $observacionesC = ""; }

        $conyuge = Conyuge::where('rut', '=', $rutC)->get()->count();
        if( $conyuge > 0  ) {
            $msg = $msg .  "\nConyuge actualizado...!";

            $registro = Conyuge::where('rut','=',$rutC)->get()->first();
            $registro->rut = $rutC;
            $registro->nombre = $nombreC;
            $registro->direccion = $direccionC;
            $registro->fechaNacimiento = $fechaNacC;
            $registro->edad = Carbon::parse($registro->fechaNacimiento)->age;
            $registro->telefono = $telefonoC;
            $registro->email = $emailC;
            $registro->observaciones = $observacionesC;

            $registro->save();

            $pacientes = Paciente::all()->sortByDesc("updated_at");
            $paciente  = Paciente::find( $paciente->id );
            $conyuge   = Conyuge::find( $registro->id );
            return view("pacientes.index",compact('pacientes', 'msg','conyuge'));
        } else {
            $conyuge = new Conyuge();
            $conyuge->rut = $rutC;
            $conyuge->nombre = $nombreC;
            $conyuge->direccion = $direccionC;
            $conyuge->email = $emailC;
            $conyuge->telefono = $telefonoC;
            $conyuge->fechaNacimiento = $fechaNacC;
            $conyuge->edad = Carbon::parse($conyuge->fechaNacimiento)->age;
            $conyuge->observaciones = $observacionesC;

            $conyuge->save();

            $pacientes = Paciente::all()->sortByDesc("updated_at");
            $msg = $msg . "Conyuge agregado exitosamente";
            $paciente  = Paciente::find( $paciente->id );
            $conyuge = Conyuge::where('rut', '=', $rutC)->get()->count();
            return view("pacientes.index",compact('pacientes','msg','conyuge'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $paciente = Paciente::find($id);        
        $paciente->delete();
        $msg = "Eliminado exitosamente";
        $pacientes = Paciente::all()->sortByDesc("updated_at");;
        return view("pacientes.index",compact('pacientes','msg'));
    }

    protected function calculoEdad($fechaNacimiento) {

        $date1=date_create( $fechaNacimiento );
        $date2=date_create( getdate());
        $diff=date_diff($date1,$date2);
        return $diff;
    }

    public function nuevoCiclo( $rut ) {
        echo "Crear Nuevo Ciclo Rut:". $rut;
    }

    public function rut( Request $request ) {
        $rutPaciente = Paciente::where('rut','=',$request->get("rut"))->get()->first();
    
        return response()->json( ['success'=> $rutPaciente]);
    }
}

