<?php

use Illuminate\Database\Seeder;

class comentarios_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++){
	         DB::table('comentarios')->insert([
		            'padre' => null,
		            'mensaje' => 'Mensaje'.$i,
		            'user_id' => random_int(1, 5),
		            'receta_id' => random_int(1, 5),
		            'time' => time()
	        ]);
	    }
    }
}
