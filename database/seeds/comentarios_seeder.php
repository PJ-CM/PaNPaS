<?php

use App\User;
use App\Receta;
use Faker\Factory;
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
        static $users;
        $id_no = 1;
        //Todos los usuarios, menos los que tengan el ID de perfil indicado (1 >> ADMIN)
        $users = User::where('perfil_id', '<>', $id_no)->get();
        static $recetas;
        $recetas = Receta::all();

        $faker = Factory::create();
        for ($i = 0; $i < 30; $i++) {

            $timestamp = mt_rand(1, time());
            $randomDate = date('Y-m-d H:i:s', $timestamp);

            DB::table('comentarios')->insert([
                'padre' => null,
                'mensaje' => $faker->realText($faker->numberBetween(10,50)),
                'user_id' => $users->random()->id,
                'receta_id' => $recetas->random()->id,
                'time' => time(),
                'leido' => $faker->numberBetween(0,1),
                'created_at' => $randomDate,
                'updated_at' => $randomDate,
            ]);
        }
    }
}
