<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientesPanaderias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingrediente_panaderia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad');
            $table->integer('panaderia_id')->unsigned();
            $table->integer('ingrediente_id')->unsigned();
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
        Schema::dropIfExists('ingredientes_panaderias');
    }
}
