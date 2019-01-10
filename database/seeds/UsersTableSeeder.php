<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++){

            if ($i == 0){
                DB::table('users')->insert([
                    'username' => 'admin',
                    'name' => 'admin',
                    'lastname' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'password' => Hash::make('admin'),
                    'perfil_id' => 1
                ]);
            }else {
                DB::table('users')->insert([
                    'username' => 'nick'.$i,
                    'name' => 'nombre'.$i,
                    'lastname' => 'apellido'.$i,
                    'email' => 'correo'.$i,
                    'password' => Hash::make(str_random(10))
                ]);
            }
        }
    }
}
