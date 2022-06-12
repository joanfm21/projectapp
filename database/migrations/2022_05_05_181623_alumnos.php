<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('dni',50)->unique()->nullable();
            $table->string('nombre',100)->nullable();
            $table->string('apellido',100)->nullable();
            $table->string('direccion',100)->nullable();
            $table->string('telefono',100)->nullable();
            $table->string('cp',100)->nullable();
            $table->string('fecha_nacimiento',100)->nullable();
            $table->string('correo',100)->unique();
            $table->string('ciclo',100)->nullable();
            $table->string('usuario_modi',30)->nullable();
        
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
        Schema::dropIfExists('alumnos');

    }
};
