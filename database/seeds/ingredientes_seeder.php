<?php

use Illuminate\Database\Seeder;

class ingredientes_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	for ($i = 0; $i < 10; $i++){
	         DB::table('ingredientes')->insert([
		            'nombre' => 'NombreIngrediente'.$i,
		            'descripcion' => 'DescripcionIngrediente'.$i
	        ]);
	    }
    }
}
