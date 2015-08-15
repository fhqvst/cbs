<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('opponent_broker_id')->unsigned();
            $table->integer('instrument_id')->unsigned();
            $table->integer('side');
            $table->bigInteger('volume');
            $table->bigInteger('position_id')->unsigned();
            $table->bigInteger('order_id')->unsigned();
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
        Schema::drop('trades');
    }
}
