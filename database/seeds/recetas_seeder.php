<?php

use App\User;
use Faker\Factory;
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
        static $users;
        //Todos los usuarios
        ////$users = User::all();
        $id_no = 1;
        //Todos los usuarios, menos el del ID especificado
        ////$users = User::all()->except($id_no);
        //Todos los usuarios, menos el del ID que inició sesión
        ////$users = User::all()->except(Auth::id());
        //Todos los usuarios, menos los que tengan el ID de perfil indicado (1 >> ADMIN)
        $users = User::where('perfil_id', '<>', $id_no)->get();

        $faker = Factory::create();
        for ($i = 0; $i < 55; $i++) {
            DB::table('recetas')->insert([
                'titulo' => 'titulo'.$i,
                'descripcion' => $faker->realText($faker->numberBetween(200,255)),
                'imagen' => $faker->imageUrl($width = 640, $height = 480),
                'elaboracion' => 'Paso 1: '.$faker->realText($faker->numberBetween(100,200)).'<br /><br />'.'Paso 2: '.$faker->realText($faker->numberBetween(150,200)).'<br /><br />'.'Paso 3: '.$faker->realText($faker->numberBetween(50,100)).'<br /><br />'.'Paso 4: '.$faker->realText($faker->numberBetween(25,50)).'<br /><br />',
                'ingredientes' => 'ingrediente'.$i.' '.$faker->numberBetween(100, 750).'ml',
                //  >> Aleatorio entre un rango de números dado
                ////'user_id' => random_int(1, 9),
                //  >> Aleatorio entre los IDs resultantes de la consulta
                'user_id' => $users->random()->id,
                'votos' => random_int(0, 0),
                'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            ]);
        }
    }
}
