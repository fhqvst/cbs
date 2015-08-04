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
        Schema::create('instruments', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('volume');
            $table->text('name');
            $table->bigInteger('visible_volume');
            $table->integer('nordnet_id')->default(0);
            $table->integer('listing_id');
            $table->integer('market_id');
            $table->bigInteger('metadata_id')->default(0);
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
