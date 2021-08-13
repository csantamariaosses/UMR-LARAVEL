<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\Ciclo2;
use App\Models\Paciente;
use App\Models\Conyuge;
use App\Models\Medico;
use App\Models\MedicoPaciente;
use App\Models\Procedimientolaboratorio;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Str;

class CicloController extends Controller
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
        $ciclos = Ciclo::all()->sortByDesc("updated_at");
        return view("ciclos.index",compact('ciclos','msg'));
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
        //echo "Store cICLO";
        
        $rut = $request->input("rut");
        $msg = "";
        //$paciente = Paciente::where('rut','=',$rut)->find(1);
        $paciente = Paciente::where("rut", "=", $rut)->get()->first();
        if( $paciente == null ) {
            $msg .= "\nPaciente no existe..!!";
            $ciclos = Ciclo::all()->sortByDesc("updated_at");;
            return view("ciclos.index",compact('ciclos','msg'));
        }

        $rutConyuge = $paciente->rutConyuge;
        if( $rutConyuge == null || $rutConyuge == "") { $rutConyuge = "";}



        $ciclo = new Ciclo();
        $ciclo->rut = $rut;
        $ciclo->rutConyuge = $rutConyuge;  
        $ciclo->rutMedico = "";  
        $ciclo->fechaRegla = Carbon::now();
        $ciclo->culdosentesis = 0;  
        $ciclo->fechaCuldosentesis = "";  
        $ciclo->transferencia = 0;  
        $ciclo->fechaTransferencia = "";  
        $ciclo->betaPositivo = 0;  
        $ciclo->betaNegativo = 0;  
        $ciclo->fechaBeta = "";  
        $ciclo->procedimientos = ""; 
        $ciclo->codProcedimientos = ""; 
        $ciclo->aco = "";  
        $ciclo->hgc = "";
        $ciclo->resultadoBetaHgc = "";            
        $ciclo->resultadoFecund = "";
        $ciclo->observaciones = "";
        $ciclo->save();
        
        $msg = "Ciclo creado exitosamente";
        $ciclos = Ciclo::all()->sortByDesc("updated_at");;
        return view("ciclos.index",compact('ciclos','msg'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ciclo  $ciclo
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        //
        $ciclo    = Ciclo::find( $id );
        $paciente = Paciente::where('rut','=',$ciclo->rut)->get()->first();
        $conyuge  = Conyuge::where( 'rut','=',$paciente->rutConyuge )->get()->first();     
        $procedLabs = Procedimientolaboratorio::all();
        $medicos = Medico::all();
   
        $ciclos = Ciclo::all()->sortByDesc("updated_at");;
        return view('ciclos.edit', compact('ciclo','paciente','conyuge','procedLabs','medicos'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ciclo  $ciclo
     * @return \Illuminate\Http\Response
     */
    public function edit(Ciclo $ciclo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ciclo  $ciclo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ciclo $ciclo)
    {
        //
        //echo  "uPDATE::" . $ciclo;

        $msg = "";
        // DATOS PACIENTE
        $rut = $request->input("rut");
        $nombre = $request->input("nombre");
        $direccion = $request->input("direccion");
        $email = $request->input("email");
        $telefono = $request->input("telefono");
        $fechaNac = $request->input("fechaNac");
        $fechaRegla = $request->input("fechaRegla");
        $antecMorb = $request->input("antecMorb");
        $diagnostico = $request->input("diagnostico");
        $observaciones = $request->input("observaciones");

    
        // DATOS CONYUGE        
        $rutConyuge           = $request->input("rutConyuge");
        $nombreConyuge        = $request->input("nombreConyuge");
        $direccionConyuge     = $request->input("direccionConyuge");
        $emailConyuge         = $request->input("emailConyuge");
        $telefonoConyuge      = $request->input("telefonoConyuge");
        $fechaNacConyuge      = $request->input("fechaNacConyuge");
        $antecMorbConyuge     = $request->input("antecMorbConyuge");
        $observacionesConyuge = $request->input("observacionesConyuge");

        // MEDICO
        $medico = $request->input("medico");


        // PROCEDS  PABELLON
        $culdo = $request->input("culdosentesis");
        $transf = $request->input("transferencia");
        $fechaCuldosentesis = $request->input("fechaCuldosentesis");
        $fechaTransferencia = $request->input("fechaTransferencia");

        // OBSERVACIONES
        $observacionesCiclo = $request->input("observacionesCiclo");

        // BETA POSITIVO-NEGATIVO
        $betaPositivo = $request->input("BetaPositivo");
        $betaNegativo = $request->input("BetaNegativo");

        // PROCEDIMIENTOS LABORATORIO NOMBRES
        $procedLabs = Procedimientolaboratorio::all();
        $procedLabsStr = "";
        //echo "<br>".$procedLabs;
        foreach ( $procedLabs as $procedLab  ) {
            //echo "<br>". $procedLab->codigo;
            $proced = $request->input($procedLab->codigo);
            if( $proced != null ) {
                //echo "Viene:" . $procedLab->codigo." ".$procedLab->nombre; 
                $procedLabsStr.= "+".$procedLab->nombre;
            }
        }
        $procedLabsStr = Str::replaceFirst('+', '',  $procedLabsStr);


        // PROCEDIMIENTOS LAB CODIGOS
        $procedLabs = Procedimientolaboratorio::all();
        $procedLabsCodStr = "";
        foreach ( $procedLabs as $procedLab  ) {
            $proced = $request->input($procedLab->codigo);
            if( $proced != null ) {
                $procedLabsCodStr.= "+".$procedLab->codigo;
            }
        }
        $procedLabsCodStr = Str::replaceFirst('+', '',  $procedLabsCodStr);
        //echo "<br>Resumen Cod Lab:" . $procedLabsCodStr;
        

        // RESULTADO FECUNDACION
        $resultadoFecund = $request->input("resultadoFecund");


      
        // VALIDACIONES
        if( $nombre == null ) { $nombre = ""; }
        if( $direccion == null ) { $direccion = ""; }
        if( $email == null ) { $email = ""; }
        if( $telefono == null ) { $telefono = ""; }
        if( $fechaNac == null ) { $fechaNac = ""; }
        if( $fechaRegla == null ) { $fechaRegla = ""; }
        if( $antecMorb == null ) { $antecMorb = ""; }
        if( $diagnostico == null ) { $diagnostico = ""; }
        if( $observaciones == null ) { $observaciones = ""; }

        if( $rutConyuge == null ) { $rutConyuge = ""; }
        if( $nombreConyuge == null ) { $nombreConyuge = ""; }
        if( $direccionConyuge == null ) { $direccionConyuge = ""; }
        if( $emailConyuge == null ) { $emailConyuge = ""; }
        if( $telefonoConyuge == null ) { $telefonoConyuge = ""; }
        if( $fechaNacConyuge == null ) { $fechaNacConyuge = 0; }
        if( $antecMorbConyuge == null ) { $antecMorbConyuge = 0; }
        if( $observacionesConyuge == null ) { $observacionesConyuge = 0; }
        
        if( $culdo == null ) { $culdo = 0; }
        if( $transf == null ) { $transf = 0; }
        if( $fechaCuldosentesis == null ) { $fechaCuldosentesis = ""; }
        if( $fechaTransferencia == null ) { $fechaTransferencia = ""; }
        if( $resultadoFecund == null ) { $resultadoFecund = ""; }
        if( $observacionesCiclo == null ) { $observacionesCiclo = ""; }

        //echo "<br>Culdo:" . $culdo;


        $aco   = $request->input("aco");
        $regla = $request->input("regla");
        $hgc   = $request->input("hgc");
        $resultadoBetaHGC = $request->input("resultadoBetaHGC");


        if( $aco == null ) { $aco = ""; }
        if( $regla == null ) { $regla = ""; }
        if( $hgc == null ) { $hgc = ""; }
        if( $resultadoBetaHGC == null ) { $resultadoBetaHGC = ""; }


        // ACTUALIZA DATOS PACIENTE
        $paciente = Paciente::where('rut','=',$rut)->get()->first();
        $paciente = Paciente::find( $paciente->id);
        echo "FechaNac:" . $fechaNac;
        $paciente->nombre = $nombre;
        $paciente->direccion = $direccion;
        $paciente->email = $email;
        $paciente->telefono = $telefono;
        $paciente->fechaNacimiento = $fechaNac;
        $paciente->diagnostico = $diagnostico;
        $paciente->observaciones = $observaciones;
        $paciente->save();


        // ACTUALIZA DATOS CONYUGE
        $conyuge_ = Conyuge::where('rut','=',$rutConyuge)->get()->first();
        $conyuge = Conyuge::find( $conyuge_->id);
        $conyuge->nombre = $nombreConyuge;
        $conyuge->direccion = $direccionConyuge;
        $conyuge->email = $emailConyuge;
        $conyuge->telefono = $telefonoConyuge;
        $conyuge->fechaNacimiento = $fechaNacConyuge;
        $conyuge->antecedMorbidos = $antecMorbConyuge;
        $conyuge->observaciones = $observaciones;
        $conyuge->save();



        // ACTUALIZA CICLO
        //echo "<br>Ciclo ID:" .  $ciclo->id;
        //echo "<br>Medico:" .  $medico;

        $ciclo = Ciclo::find($ciclo->id);
        $ciclo->rutConyuge = $rutConyuge;
        $ciclo->culdosentesis = $culdo;
        $ciclo->fechaCuldosentesis = $fechaCuldosentesis;
        $ciclo->fechaTransferencia = $fechaTransferencia;
        $ciclo->transferencia = $transf;
        $ciclo->codProcedimientos = $procedLabsCodStr;
        $ciclo->procedimientos = $procedLabsStr;
        $ciclo->rutMedico = $medico;
        $ciclo->aco = $aco;
        $ciclo->fechaRegla = $fechaRegla;
        $ciclo->hgc = $hgc;
        $ciclo->resultadoBetaHgc = $resultadoBetaHGC;
        $ciclo->resultadoFecund = $resultadoFecund;
        $ciclo->observaciones = $observacionesCiclo;
        
        $ciclo->save();

        $ciclos = Ciclo::all()->sortByDesc("updated_at");;
        return view("ciclos.index",compact('ciclos','msg'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ciclo  $ciclo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ciclo $ciclo)
    {
        $ciclo = Ciclo::find($ciclo)->first();        
        $ciclo->delete();

        $ciclos = Ciclo::all()->sortByDesc("updated_at");;
        return view("ciclos.index",compact('ciclos'));
    }

    public function test() {
        echo "Test";
        $msg = "";
        $ciclos = Ciclo::all()->sortByDesc("updated_at");
        $ciclo2s = Ciclo2::all()->sortByDesc("updated_at");
        return view("ciclos.test",compact('ciclo2s','msg'));
    }

    public function guardar(Request $request) {
        echo "Guardar";
        $rutPaciente = $request->input("rutPaciente");
        //$rutConyuge  = $request->input("rutConyuge");
        //$rutMedico = $request->input("rutMedico");

        $paciente = Paciente::where('rut','=',$rutPaciente)->get()->first();
        //$conyuge  = Conyuge::where('rut','=',$rutConyuge)->get()->first();
        //$medico   = Medico::where('rut','=',$rutMedico)->get()->first();


        $ciclo2 = new Ciclo2();
        $ciclo2->medico_id = null;
        $ciclo2->paciente_id = $paciente->id;  
        $ciclo2->conyuge_id = null;  

        $ciclo2->observaciones = "BLABLAL";
        $ciclo2->observaciones = "BLABLAL";
        $ciclo2->observaciones = "BLABLAL";

        $ciclo2->fechaRegla = Carbon::now();
        $ciclo2->culdosentesis = 0;  
        $ciclo2->fechaCuldosentesis = "";  
        $ciclo2->transferencia = 0;  
        $ciclo2->fechaTransferencia = "";  
        $ciclo2->betaPositivo = 0;  
        $ciclo2->betaNegativo = 0;  
        $ciclo2->fechaBeta = "";  
        $ciclo2->procedimientos = ""; 
        $ciclo2->codProcedimientos = ""; 
        $ciclo2->aco = "";  
        $ciclo2->hgc = "";
        $ciclo2->resultadoBetaHgc = "";            
        $ciclo2->resultadoFecund = "";
        $ciclo2->observaciones = "Observaciones";

        $ciclo2->save();
        
        $msg = "Ciclo creado exitosamente";
        $ciclo2s = Ciclo2::all()->sortByDesc("updated_at");
        return view("ciclos.test",compact('ciclo2s','msg')); 
        //echo $ciclo2s;

        //exit();
        //return view("ciclos.test",compact('ciclo2s','msg')); 




       // $medicoPaciente = new MedicoPaciente();  

        //$medicoPaciente->medico_id = $medico;
        //$medicoPaciente->paciente_id = $paciente;
/*
        $medicoPaciente->attach($medico, $paciente);
        echo "RutP:" . $rutPaciente;
        echo "RutM:" . $rutMedico;

        $fechaRegla = Carbon::now();
        $culdosentesis = 1;
        $observaciones = "Observaciones";
        $datos = [
            "fechaRegla" => $fechaRegla,
            "culdosentesis" => $culdosentesis,
            "observaciones" => $observaciones
        ];
        $medico->pacientes()->attach($paciente->id, $datos);



        $msg = "Ok...";
        $ciclos = Ciclo::all()->sortByDesc("updated_at");
        return view("ciclos.test",compact('ciclos','msg'));
*/


        

    }

    public function listado() {
        $ciclos = Ciclo::all()->sortByDesc("updated_at");


    }
}



