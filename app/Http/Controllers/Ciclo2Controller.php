<?php

namespace App\Http\Controllers;

use App\Models\Ciclo2;
use App\Models\Paciente;
use App\Models\Conyuge;
use App\Models\Medico;
use App\Models\Procedimientolaboratorio;
use App\Models\Estadociclo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Ciclo2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $msg = "";
        $ciclo2s = Ciclo2::all()->sortByDesc("updated_at");
        
        if( count( $ciclo2s ) == 0 ) { 
            echo "Ciclos vacio";
        }


        return view("ciclo2s.index",compact('ciclo2s','msg'));
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
        $conyuge_id = 0;
        $rutPaciente = $request->input("rutPaciente");
       
        $paciente = Paciente::where('rut','=',$rutPaciente)->get()->first();
        if( $paciente == null ) {
            $msg = "Paciente no existe, favor ingresarlo..";
            $ciclo2s = Ciclo2::all()->sortByDesc("updated_at");
            return view("ciclo2s.index",compact('ciclo2s','msg')); 
        }
        
        $conyuge  = Conyuge::where('rut','=',$paciente->rutConyuge)->get()->first();
        

        if( $conyuge == null ) {
            $conyuge_id = null;  
        } else {
            $conyuge_id = $conyuge->id;  
        }
        
        $ciclo2 = new Ciclo2();
        $ciclo2->medico_id = null;
        $ciclo2->paciente_id = $paciente->id;  
        $ciclo2->conyuge_id = $conyuge_id;  

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
        //echo "Pac:". $ciclo2s->paciente->nombre;


        return view("ciclo2s.index",compact('ciclo2s','msg')); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ciclo2  $ciclo2
     * @return \Illuminate\Http\Response
     */
    public function show(Ciclo2 $ciclo2)
    {
        //
        $ciclo2    = Ciclo2::find( $ciclo2->id );
        $procedLabs = Procedimientolaboratorio::all();
        $medicos = Medico::all();
        $estadociclos = Estadociclo::all();
   
        $ciclo2s = Ciclo2::all()->sortByDesc("updated_at");;
        return view('ciclo2s.edit', compact('ciclo2s','ciclo2','procedLabs','medicos','estadociclos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ciclo2  $ciclo2
     * @return \Illuminate\Http\Response
     */
    public function edit(Ciclo2 $ciclo2)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ciclo2  $ciclo2
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ciclo2 $ciclo2)
    {
        //
      

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
        if ( $medico == 0 ) {
            $medico = null;
        }
        
    
        // PROCEDS  PABELLON
        $culdo = $request->input("culdosentesis");
        $transf = $request->input("transferencia");
        $fechaCuldosentesis = $request->input("fechaCuldosentesis");
        $fechaTransferencia = $request->input("fechaTransferencia");

        // OBSERVACIONES
        $observacionesCiclo = $request->input("observacionesCiclo");

        // BETA POSITIVO-NEGATIVO
        $betaPositivo = 0;
        $betaNegativo = 0;

        $beta = $request->input("beta");
        if ( $beta !=  null  )  {
            if( $beta == 1) {
                $betaPositivo = 1;
                $betaNegativo = 0;
            } else {
                $betaPositivo = 0;
                $betaNegativo = 1;
            }
        }

        $fechaBeta = $request->input("fechaBeta");
        if( $fechaBeta == null ) {
            $fechaBeta = "";
        }

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

        // ESTADO CICLO
        $estadociclo = $request->input("estadociclo"); 

      
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
        if( $estadociclo == null ) { $estadociclo = ""; }
        if( $observacionesCiclo == null ) { $observacionesCiclo = ""; }

        echo "estado ciclo:" . $estadociclo;

     


        
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
        $paciente->nombre = $nombre;
        $paciente->direccion = $direccion;
        $paciente->email = $email;
        $paciente->telefono = $telefono;
        $paciente->fechaNacimiento = $fechaNac;
        $paciente->diagnostico = $diagnostico;
        $paciente->observaciones = $observaciones;
        $paciente->save();


        // ACTUALIZA DATOS CONYUGE
        if( $rutConyuge != "") {
            $conyuge_ = Conyuge::where('rut','=',$rutConyuge)->get()->first();    
            $conyuge = Conyuge::find( $conyuge_->id);
            $conyuge->nombre = $nombreConyuge;
            $conyuge->direccion = $direccionConyuge;
            $conyuge->email = $emailConyuge;
            $conyuge->telefono = $telefonoConyuge;
            $conyuge->fechaNacimiento = $fechaNacConyuge;
            $conyuge->antecedMorbidos = $antecMorbConyuge;
            $conyuge->observaciones = $observacionesConyuge;
            $conyuge->save();
    
        }




        // ACTUALIZA CICLO
        $ciclo2 = Ciclo2::find($ciclo2->id);
        //$ciclo2->rutConyuge = $conyuge->id;
        $ciclo2->culdosentesis = $culdo;
        $ciclo2->fechaCuldosentesis = $fechaCuldosentesis;
        $ciclo2->fechaTransferencia = $fechaTransferencia;
        $ciclo2->transferencia = $transf;
        $ciclo2->codProcedimientos = $procedLabsCodStr;
        $ciclo2->procedimientos = $procedLabsStr;
        $ciclo2->medico_id = $medico;
        $ciclo2->aco = $aco;
        $ciclo2->fechaRegla = $fechaRegla;
        $ciclo2->hgc = $hgc;
        $ciclo2->resultadoBetaHgc = $resultadoBetaHGC;
        $ciclo2->resultadoFecund = $resultadoFecund;
        $ciclo2->betaPositivo = $betaPositivo;
        $ciclo2->betaNegativo = $betaNegativo;
        $ciclo2->fechaBeta = $fechaBeta;
        $ciclo2->estadociclo_id = $estadociclo;
        $ciclo2->observaciones = $observacionesCiclo;
        
        $ciclo2->save();

        $ciclo2s = Ciclo2::all()->sortByDesc("updated_at");;
        return view("ciclo2s.index",compact('ciclo2s','msg'));
        


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ciclo2  $ciclo2
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ciclo2 $ciclo2)
    {
        //
        $ciclo2 = Ciclo2::find($ciclo2)->first();        
        $ciclo2->delete();

        $msg = "Ciclo eliminado...";
        $ciclo2s = Ciclo2::all()->sortByDesc("updated_at");;
        return view("ciclo2s.index",compact('ciclo2s', 'msg'));
    }

    public function listadoCiclos(){
        $msg = "";
        $ciclo2s = Ciclo2::all()->sortByDesc("updated_at");;
        return view("ciclo2s.listado",compact('ciclo2s','msg'));
    }
}
