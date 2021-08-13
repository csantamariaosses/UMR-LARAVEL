<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicoPacienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medico_paciente', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('medico_id');
            $table->foreign('medico_id')
             ->references('id')
             ->on('medicos');

            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')
            ->references('id')
            ->on('pacientes');
            
            $table->date("fechaRegla");  
            $table->integer("culdosentesis");  
            $table->string("observaciones");  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medico_paciente');
    }
}
