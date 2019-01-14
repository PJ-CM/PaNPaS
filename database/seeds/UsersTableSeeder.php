<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < 11; $i++){

            if ($i == 0){
                DB::table('users')->insert([
                    'username' => 'admin',
                    'name' => 'admin',
                    'lastname' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'password' => Hash::make('admin'),
                    'perfil_id' => 1,
                    'avatar' => $faker->imageUrl($width = 640, $height = 480)
                ]);
            }else if ($i < 10) {
                DB::table('users')->insert([
                    'username' => $faker->username(),
                    'name' => $faker->name(),
                    'lastname' => $faker->lastname(),
                    'email' => $faker->email(),
                    'password' => Hash::make(str_random(10)),
                    'avatar' => $faker->imageUrl($width = 640, $height = 480)
                ]);
            } else {
               DB::table('users')->insert([
                        'username' => 'Eneko',
                        'name' => 'Eneko',
                        'lastname' => 'Apellido',
                        'email' => 'Eneko@gmail.com',
                        'password' => Hash::make('usuario'),
                        'avatar' => $faker->imageUrl($width = 640, $height = 480)
                    ]);                
            }
        }
    }
}
