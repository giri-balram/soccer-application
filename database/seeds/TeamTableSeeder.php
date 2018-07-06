<?php

use Illuminate\Database\Seeder;

class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        return factory(App\Team::class, 8)->create();
    }
}
