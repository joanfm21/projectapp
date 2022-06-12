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
        Schema::create('alumno_ufs', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedBigInteger('cualificacion')->unsigned()->default(1);
            $table->unsignedInteger("uf_id")->nullable();
            $table->foreign("uf_id")->references('id')->on('ufs')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->unsignedInteger("alumno_id")->nullable();
            $table->foreign("alumno_id")->references('id')->on('alumnos')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->unique( array('uf_id','alumno_id'));
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
        Schema::dropIfExists('alumno_ufs');
    }
};
