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
        Schema::create('trades', function($table) {
            $table->bigIncrements('id');
            $table->integer('instrument_id');
            $table->integer('buyer_id'); // user_id
            $table->integer('seller_id'); // user_id
            $table->bigInteger('volume');
            $table->decimal('price', 19, 4);
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
