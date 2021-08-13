<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiclosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciclos', function (Blueprint $table) {
            $table->id();
            $table->string("rut");  
            $table->string("rutConyuge");  
            $table->string("rutMedico");  
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


