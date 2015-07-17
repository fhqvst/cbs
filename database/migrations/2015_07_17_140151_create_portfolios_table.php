<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function($table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->decimal('own_capital', 19, 4);
            $table->decimal('balance', 19, 4);
            $table->decimal('profit', 19, 4);
            $table->decimal('total_value', 19, 4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('portfolios');
    }
}
