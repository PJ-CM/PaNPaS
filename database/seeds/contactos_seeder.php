<?php

use Illuminate\Database\Seeder;

class contactos_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


	    for ($i = 0; $i < 10; $i++){
	         DB::table('contactos')->insert([
		            'nombre' => 'nombre'.$i,
		            'correo' => 'correo'.$i,
		            'mensaje' => 'mensaje'.$i
	        ]);
	    }
    }
}
