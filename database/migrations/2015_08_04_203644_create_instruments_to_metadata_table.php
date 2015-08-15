<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstrumentsToMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instruments_metadata', function (Blueprint $table) {
            $table->integer('instrument_id')->unsigned();
            $table->bigInteger('metadata_id')->unsigned();
            $table->primary(['instrument_id', 'metadata_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('instruments_metadata');
    }
}
