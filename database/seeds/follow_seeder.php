<?php

use Illuminate\Database\Seeder;

class follow_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            DB::table('user_user')->insert([
                'follower' => random_int(1, 11),
                'followed' => random_int(1, 11),
            ]);
        }
    }
}
