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
        Schema::create('modulos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('ciclo',100)->nullable();
            $table->string('modulo',100)->nullable();
            $table->string('descripcion_modulo',100)->nullable();
            $table->string('comentarios')->nullable();
            $table->unsignedInteger("usuario_id")->nullable();
            $table->foreign("usuario_id")->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('set null');
            $table->unsignedInteger("ciclo_id");
            $table->foreign("ciclo_id")->references('id')->on('ciclos')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('usuario_modi',100)->nullable();
            $table->unique( array('ciclo','modulo'))->nullable();
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
        Schema::dropIfExists('modulos');
    }
};
