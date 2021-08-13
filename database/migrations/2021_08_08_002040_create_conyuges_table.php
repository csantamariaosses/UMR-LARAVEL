<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConyugesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conyuges', function (Blueprint $table) {
            $table->id();
            $table->string("rut");
            $table->string("nombre");
            $table->string("email");
            $table->string("direccion");
            $table->string("telefono");
            $table->string("fechaNacimiento");
            $table->string("edad");
            $table->string("antecedMorbidos");
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
        Schema::dropIfExists('conyuges');
    }
}
