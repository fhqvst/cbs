<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function(Blueprint $table) {
            $table->integer('instrument_id');
            $table->decimal('open', 19, 4);
            $table->decimal('high', 19, 4);
            $table->decimal('low', 19, 4);
            $table->decimal('close', 19, 4);
            $table->dateTime('logged_at');
            $table->bigInteger('volume');
            $table->primary(['instrument_id', 'logged_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quotes');
    }
}
