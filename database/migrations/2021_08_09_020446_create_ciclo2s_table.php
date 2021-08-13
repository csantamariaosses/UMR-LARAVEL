<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiclo2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciclo2s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medico_id')->nullable();
            $table->foreign('medico_id')
             ->references('id')
             ->on('medicos');

            $table->unsignedBigInteger('paciente_id')->nullable();
            $table->foreign('paciente_id')
            ->references('id')
            ->on('pacientes');

            $table->unsignedBigInteger('conyuge_id')->nullable();
            $table->foreign('conyuge_id')
            ->references('id')
            ->on('conyuges');

            $table->date("fechaRegla");  
            $table->integer("culdosentesis");  
            $table->string("fechaCuldosentesis"); 
            
            $table->integer("transferencia");  
            $table->string("fechaTransferencia");  
            
            $table->integer("betaPositivo");  
            $table->integer("betaNegativo");  
            $table->string("fechaBeta");  

            $table->string("codProcedimientos");  
            $table->string("procedimientos");  
            $table->string("aco");  
            $table->string("hgc");
            $table->string("resultadoBetaHgc");            
            $table->string("resultadoFecund");

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
        Schema::dropIfExists('ciclos');
    }
}


