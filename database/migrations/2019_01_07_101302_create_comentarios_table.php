<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('padre')->nullable();
            $table->string('mensaje');
            $table->integer('user_id')->unsigned();
            $table->integer('receta_id')->unsigned();
            $table->integer('time');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('receta_id')->references('id')->on('recetas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comentarios');
    }
}
