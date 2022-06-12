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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('nombre',100)->nullable();
            $table->string('apellido',100)->nullable();
            $table->string('email',100)->unique();
            $table->string('password',250);
            $table->string('ciclo',100)->nullable();
            $table->enum("rol", ["admin", "profesor"]);
            $table->string('remember_token',255)->nullable();
            $table->string('usuario_modi',100)->nullable();
            $table->timestamps();
            $table->boolean('super_admin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
