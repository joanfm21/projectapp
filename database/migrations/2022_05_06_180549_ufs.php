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
        Schema::create('ufs', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('nombre',100)->nullable();
            $table->integer('horas')->unsigned()->nullable()->default(0);
            $table->string('descripcion',100)->nullable();
            $table->unsignedInteger("modulo_id")->nullable();
            $table->foreign("modulo_id")->references('id')->on('modulos')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->string('usuario_modi',100)->nullable();
            $table->unique( array('nombre','modulo_id'))->nullable();
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
        Schema::dropIfExists('ufs');

    }
};
