<?php

use App\User;
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

        //Para la creación de usuarios
        //  >> usuarios genéricos fijos
        $this->call(UsersTableSeeder::class);
        //  >> otros usuarios aleatorios
        factory(User::class, 25)->create();

        $this->call(ingredientes_seeder::class);
        $this->call(panaderias_seeder::class);

        $this->call(recetas_seeder::class);

        $this->call(ingredientesPanaderias_seeder::class);
        $this->call(ingredientesRecetas_seeder::class);

        $this->call(comentarios_seeder::class);
        $this->call(comentarioUser_seeder::class);

        $this->call(follow_seeder::class);
    }
}
