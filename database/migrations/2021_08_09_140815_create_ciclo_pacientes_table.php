<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCicloPacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciclo_pacientes', function (Blueprint $table) {
            $table->id();
            $table->string("codigo");
            $table->string("rutPaciente");
            $table->string("nombre");            
            $table->string("rutConyuge");
            $table->string("progesterona");
            $table->string("betaPositivo");
            $table->string("betaNegativo");
            $table->string("edadPaciente");
            $table->string("edadConyuge");
            $table->string("diagnostico");
            $table->string("codMedico");
            $table->string("aco");  // Anti Comceptivo Oral
            $table->string("regla");
            $table->string("hgc");  // Hormona
            $table->string("transferencia");
            $table->string("fechaTransferencia");            
            $table->string("resultFecundacion");
            $table->string("observacion");
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
        Schema::dropIfExists('ciclo_pacientes');
    }
}
