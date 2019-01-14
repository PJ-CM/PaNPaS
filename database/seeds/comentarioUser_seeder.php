<?php

use Illuminate\Database\Seeder;

class comentarioUser_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++){
	         DB::table('comentario_user')->insert([
		            'comentario_id' => random_int(1, 5),
		            'user_id' => random_int(1, 5)
		            
	        ]);
	    }
    }
}
