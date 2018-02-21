<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        //
        Schema::create('_persona_',function (Blueprint $table){
          $table->int('CI')->index();
          $table->string('Nombre');
          $table->string('Apellido');
          $table->date('FechaNac');
          $table->string('Email');
          $table->string('UsuIngreso');
          $table->date('FechaIngreso');
        });

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_persona_');
    }
}
