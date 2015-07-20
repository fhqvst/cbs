<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function($table) {
            $table->increments('id');
            $table->integer('instrument_id');
            $table->bigInteger('volume');
            $table->decimal('price', 19, 4);
            $table->decimal('profit', 19, 4);
            $table->decimal('market_value', 19, 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('positions');
    }
}
