<?php

use Illuminate\Database\Seeder;

class perfiles_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perfiles')->insert([
            'nombre' => 'Administrador',
            'descripcion' => 'Usuario Root',
        ]);

        DB::table('perfiles')->insert([
            'nombre' => 'Usuario',
            'descripcion' => 'Usuario Normal',
        ]);
    }
}
