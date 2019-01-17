<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkIngredientesRecetas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingrediente_receta', function (Blueprint $table) {
            $table->foreign('ingrediente_id')->references('id')->on('ingredientes');
            $table->foreign('receta_id')->references('id')->on('recetas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
