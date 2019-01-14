<?php

use Illuminate\Database\Seeder;

class ingredientesRecetas_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++){
	         DB::table('ingrediente_receta')->insert([
		            'ingrediente_id' => random_int(1, 9),
		            'receta_id' => random_int(1, 9)
	        ]);
   		}
	}
}
