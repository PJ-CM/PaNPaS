<?php

use Illuminate\Database\Seeder;

class recetas_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++){
	         DB::table('recetas')->insert([
		            'titulo' => 'titulo'.$i,
		            'descripcion' => 'correo'.$i,
		            'imagen' => 'imagen'.$i,
		            'elaboracion' => 'elaboracion'.$i,
		            'user_id' => random_int(1, 9)
	        ]);
	    }
    }
}
