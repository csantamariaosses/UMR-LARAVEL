<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    public function pacientes(){
        return $this->belongsToMany( 'App\Models\Paciente'  )->withTimestamps();
    }

}
