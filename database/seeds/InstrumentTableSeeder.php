<?php

use Illuminate\Database\Seeder;

class InstrumentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Instrument', 10)->create()->save();
    }
}
