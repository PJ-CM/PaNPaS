<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
class users_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < 9; $i++){

            if ($i == 0){
               DB::table('users')->insert([
                    'nick' => 'nick'.$i,
                    'nombre' => 'admin',
                    'apellido' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'password' => Hash::make('admin'),
                    'perfil_id' => 1,
                    'avatar' => $faker->imageUrl($width = 640, $height = 480)
                ]); 
            }else if ($i < 9){
    	       DB::table('users')->insert([
                        'nick' => 'Eneko',
                        'nombre' => 'Eneko',
                        'apellido' => 'Apellido',
                        'email' => 'Eneko@gmail.com',
                        'password' => Hash::make('usuario'),
                        'avatar' => $faker->imageUrl($width = 640, $height = 480)
                    ]);
                ]);
            } else {
                
            }
        }

        

    }
}
