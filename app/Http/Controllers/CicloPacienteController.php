<?php

namespace App\Http\Controllers;

use App\Models\CicloPaciente;
use App\Models\Ciclo;
use App\Models\Paciente;
use Illuminate\Http\Request;


class CicloPacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $ciclos = Ciclo::all();
        $pacientes = Paciente::all();
        $registros = CicloPaciente::all()->sortByDesc("updated_at");

        return view("cicloPacientes.index",compact('registros','ciclos','pacientes'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CicloPaciente  $cicloPaciente
     * @return \Illuminate\Http\Response
     */
    public function show(CicloPaciente $cicloPaciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CicloPaciente  $cicloPaciente
     * @return \Illuminate\Http\Response
     */
    public function edit(CicloPaciente $cicloPaciente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CicloPaciente  $cicloPaciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CicloPaciente $cicloPaciente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CicloPaciente  $cicloPaciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(CicloPaciente $cicloPaciente)
    {
        //
    }
}
