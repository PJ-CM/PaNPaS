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
        //  >> usuarios genéricos fijos
        $tot_users = 3;
        $faker = Factory::create();
        for ($i = 0; $i < $tot_users; $i++) {

            $timestamp = mt_rand(1, time());
            $randomDate = date('Y-m-d H:i:s', $timestamp);

            if ($i == 0) {
                DB::table('users')->insert([
                    'username' => 'admin',
                    'name' => 'admin',
                    'lastname' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make('admin'),
                    'perfil_id' => 1,
                    'avatar' => $faker->imageUrl($width = 640, $height = 480),
                    'created_at' => $randomDate,
                    'updated_at' => $randomDate,
                ]);

            } else if ($i == 1) {
                DB::table('users')->insert([
                    'username' => 'usu',
                    'name' => 'usu',
                    'lastname' => 'Usu',
                    'email' => 'usu@gmail.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make('xxxxxx'),
                    'avatar' => $faker->imageUrl($width = 640, $height = 480),
                    'created_at' => $randomDate,
                    'updated_at' => $randomDate,
                ]);

            } else if ($i == 2) {
                DB::table('users')->insert([
                    'username' => 'Eneko',
                    'name' => 'Eneko',
                    'lastname' => 'Apellido',
                    'email' => 'Eneko@gmail.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make('usuario'),
                    'avatar' => $faker->imageUrl($width = 640, $height = 480),
                    'created_at' => $randomDate,
                    'updated_at' => $randomDate,
                ]);

            }

        }
    }
}
