<?php

use Illuminate\Database\Seeder;

class ingredientesPanaderias_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            DB::table('ingrediente_panaderia')->insert([
                'cantidad' => random_int(0, 999),
                'panaderia_id' => random_int(1, 9),
                'ingrediente_id' => random_int(1, 9),
            ]);
        }
    }
}
