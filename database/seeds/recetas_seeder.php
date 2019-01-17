<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
class recetas_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < 30; $i++){
	         DB::table('recetas')->insert([
		            'titulo' => 'titulo'.$i,
		            'descripcion' => $faker->realText($faker->numberBetween(200,255)),
		            'imagen' => $faker->imageUrl($width = 640, $height = 480),
		            'elaboracion' => 'elaboracion'.$i,
		            'user_id' => random_int(1, 9),
                    'votos' => random_int(0, 999),
                    'created_at' => $faker->date($format = 'Y-m-d', $max = 'now')
	        ]);
	    }
    }
}
