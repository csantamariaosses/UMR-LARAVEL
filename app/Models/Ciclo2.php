<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciclo2 extends Model
{
    use HasFactory;

    public function paciente(){
        return $this->belongsTo( 'App\Models\Paciente' );
    }

    public function conyuge(){
        return $this->belongsTo( 'App\Models\Conyuge');
    }

    public function medico(){
        return $this->belongsTo( 'App\Models\Medico');
    }
}
