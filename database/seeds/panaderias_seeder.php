<?php

use Illuminate\Database\Seeder;

class panaderias_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	for ($i = 0; $i < 10; $i++){
	         DB::table('panaderias')->insert([
		            'nombre' => 'nombrePanaderia'.$i,
		            'descripcion' => 'descripcionPanaderia'.$i,
		            'user_id' => random_int(1, 9)
	        ]);
	    }
    }
}
