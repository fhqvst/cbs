<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('portfolio_id')->unsigned();
            $table->decimal('price', 19, 4);
            $table->bigInteger('volume');
            $table->dateTime('expires_at');
            $table->integer('queue_position');
            $table->tinyInteger('side');
            $table->integer('instrument_id')->unsigned();
            $table->integer('status');
            $table->integer('type');
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
        Schema::drop('orders');
    }
}
