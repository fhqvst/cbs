<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class StockTableSeeder extends Seeder {

    public function run()
    {
        DB::table('stocks')->delete();

        App\Stock::create(array(
            'symbol' => 'AOI',
            'name' => 'Africa Oil',
            'buy' => 300.50,
            'sell' => 300.75,
            'change' => -20.0,
            'change_percent' => -6.65,
            'volume' => 100000,
            'available' => 0
        ));

        App\Stock::create(array(
            'symbol' => 'SEB A',
            'name' => 'SEB A',
            'buy' => 300.50,
            'sell' => 300.75,
            'change' => -20.0,
            'change_percent' => -6.65,
            'volume' => 100000,
            'available' => 0
        ));

        App\Stock::create(array(
            'symbol' => 'SAND',
            'name' => 'Sandvik',
            'buy' => 300.50,
            'sell' => 300.75,
            'change' => -20.0,
            'change_percent' => -6.65,
            'volume' => 100000,
            'available' => 0
        ));

        App\Stock::create(array(
            'symbol' => 'RATO B',
            'name' => 'Ratos B',
            'buy' => 300.50,
            'sell' => 300.75,
            'change' => -20.0,
            'change_percent' => -6.65,
            'volume' => 100000,
            'available' => 0
        ));

        App\Stock::create(array(
            'symbol' => 'SWED A',
            'name' => 'Swedbank A',
            'buy' => 300.50,
            'sell' => 300.75,
            'change' => -20.0,
            'change_percent' => -6.65,
            'volume' => 100000,
            'available' => 0
        ));

        App\Stock::create(array(
            'symbol' => 'VOLV B',
            'name' => 'Volvo B',
            'buy' => 300.50,
            'sell' => 300.75,
            'change' => -20.0,
            'change_percent' => -6.65,
            'volume' => 100000,
            'available' => 0
        ));

        App\Stock::create(array(
            'symbol' => 'TLSN',
            'name' => 'TeliaSonera',
            'buy' => 300.50,
            'sell' => 300.75,
            'change' => -20.0,
            'change_percent' => -6.65,
            'volume' => 100000,
            'available' => 0
        ));

        App\Stock::create(array(
            'symbol' => 'ERIC B',
            'name' => 'Ericsson B',
            'buy' => 300.50,
            'sell' => 300.75,
            'change' => -20.0,
            'change_percent' => -6.65,
            'volume' => 100000,
            'available' => 0
        ));

        App\Stock::create(array(
            'symbol' => 'INVE B',
            'name' => 'Investor B',
            'buy' => 300.50,
            'sell' => 300.75,
            'change' => -20.0,
            'change_percent' => -6.65,
            'volume' => 100000,
            'available' => 0
        ));

        App\Stock::create(array(
            'symbol' => 'HM B',
            'name' => 'Hennes & Mauritz B',
            'buy' => 300.50,
            'sell' => 300.75,
            'change' => -20.0,
            'change_percent' => -6.65,
            'volume' => 100000,
            'available' => 0
        ));

    }

}