<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
    //

    public function acceso(Request $request)
    {


        //

        $usuario = $request->input("usuario");
        $password = $request->input("password");

       
        $this->debug_to_console("usuario:" . $usuario);
        $this->debug_to_console("pass:" . $password);

              
        $admin = false;
       
        //$pass = md5($passwordAcc);

        $registro = DB::table('usuarios')
                    //->select('email')
                    ->where('email',$usuario)
                    ->where('password',$password)
                    ->get();
        $countRegistros = count( $registro );

        $this->debug_to_console("pass:" . $countRegistros);

        if( count( $registro ) > 0 ) {
            $email  = $registro[0]->email;
            $nombre = $registro[0]->nombre;
            $perfil = $registro[0]->perfil;

            //Inicio Sesion           
            $request->session()->put('email',$email);
            $request->session()->put('nombre',$nombre);
            $request->session()->put('perfil',$perfil);
                
           if( strcmp( $perfil,'admin')==0){
                $admin = true;
            }
            $usuario = DB::table('usuarios')
                        ->where('email', $email)
                        ->get();
            $infoUser = $usuario[0];
            /*
            $parametros = DB::table('parametros')->get();  
            $items = DB::table('menus')
                             ->orderBy('subMenu')
                             ->get();
                             */
            return view("usuarios.wellcome",compact('email'));
        } else {
            /*
            $parametros = DB::table('parametros')->get();  
            $items = DB::table('menus')
                         ->orderBy('subMenu')
                         ->get();
            */                 
            return redirect('/')->with('alert-warning','Usuario - Password no corresponden. Favor reintentar.'); 

        }
        
        
    
      
    }


    public function logout() {

        echo "Salir!";
        
        \Session::forget('usuario');
        \Session::forget('email');
        \Session::forget('nombre');
        \Session::forget('fonoContacto');
        \Session::forget('tipo');
        \Session::forget('carritoCotizacion');
        \Session::forget('carritoCotizacionInterna');

        return redirect("/");
        

    }


    public function home(){
        //return redirect "usuarios.home";
        return view("usuarios.wellcome");
    }


    protected function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }
}
