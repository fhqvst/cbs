<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstrumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instruments', function($table) {
            $table->increments('id');
            $table->string('symbol');
            $table->text('name');
            $table->bigInteger('nordnet_id')->default(0);
            $table->integer('market_id')->default(0);
            $table->string('sector')->default('NO_SECTOR');
            $table->string('isin_code')->default(0);
            $table->integer('listing_id')->default(0);
            $table->integer('metadata_id')->default(0);
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
        Schema::drop('instruments');
    }
}
