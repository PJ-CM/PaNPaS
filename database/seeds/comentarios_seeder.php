<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
class comentarios_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++){
	         DB::table('comentarios')->insert([
		            'padre' => null,
		            'mensaje' => $faker->realText($faker->numberBetween(10,50)),
		            'user_id' => random_int(1, 5),
		            'receta_id' => random_int(1, 5),
		            'time' => time()
	        ]);
	    }
    }
}
