<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategEnumRecetas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recetas', function (Blueprint $table) {
            $table->enum('categoria', ['panadería', 'pastelería'])
                    ->after('user_id')
                    ->default('panadería');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recetas', function (Blueprint $table) {
            //
        });
    }
}
