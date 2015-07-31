<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstrumentMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrument_meta', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('instrument_id');
            $table->string('meta_key');
            $table->longtext('meta_value');
            $table->date('logged_at');
            $table->unique(array('meta_key', 'logged_at'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('instrument_meta');
    }
}
