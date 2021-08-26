<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcedimientopacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedimientopacientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ciclo2_id')->nullable();
            $table->foreign('ciclo2_id')
                  ->references('id')
                  ->on('ciclo2s');

            $table->string("rut");
            $table->string("codigo");
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
        Schema::dropIfExists('procedimientopacientes');
    }
}
