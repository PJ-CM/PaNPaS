<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkIngredientesPanaderias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingrediente_panaderia', function (Blueprint $table) {
            $table->foreign('panaderia_id')->references('id')->on('panaderias')->onDelete('cascade');
            $table->foreign('ingrediente_id')->references('id')->on('ingredientes');
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
