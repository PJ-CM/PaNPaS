<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(contactos_seeder::class);

        $this->call(perfiles_seeder::class);
        $this->call(users_seeder::class);

        
        $this->call(ingredientes_seeder::class);
        $this->call(panaderias_seeder::class);
        
        $this->call(recetas_seeder::class);

        $this->call(ingredientesPanaderias_seeder::class);
        $this->call(ingredientesRecetas_seeder::class);
        
        $this->call(comentarios_seeder::class);
        
    }
}
