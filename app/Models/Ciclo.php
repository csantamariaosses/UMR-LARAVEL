<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    use HasFactory;

    public function medicos(){
        return $this->belongsToMany( 'App\Models\Medico'  );
    }
}
