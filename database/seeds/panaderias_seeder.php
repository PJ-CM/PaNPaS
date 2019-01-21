<?php

use App\User;
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
        static $users;
        $id_no = 1;
        //Todos los usuarios, menos los que tengan el ID de perfil indicado (1 >> ADMIN)
        $users = User::where('perfil_id', '<>', $id_no)->get();
        //Ver otras opciones de restricción en el seeder de RECETAS

        for ($i = 0; $i < 20; $i++) {
            DB::table('panaderias')->insert([
                'nombre' => 'nombrePanaderia'.$i,
                'descripcion' => 'descripcionPanaderia'.$i,
                'user_id' => $users->random()->id,
            ]);
        }
    }
}
