<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portfolios', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('trades', function(Blueprint $table) {
            $table->foreign('opponent_broker_id')->references('id')->on('brokers');
            $table->foreign('instrument_id')->references('id')->on('instruments');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->foreign('order_id')->references('id')->on('orders');
        });

        Schema::table('positions', function(Blueprint $table) {
            $table->foreign('instrument_id')->references('id')->on('instruments');
            $table->foreign('portfolio_id')->references('id')->on('portfolios');
        });

        Schema::table('instruments', function(Blueprint $table) {
            $table->foreign('listing_id')->references('id')->on('listings');
        });

        Schema::table('instruments_markets', function(Blueprint $table) {
            $table->foreign('instrument_id')->references('id')->on('instruments');
            $table->foreign('market_id')->references('id')->on('markets');
        });

        Schema::table('instruments_metadata', function(Blueprint $table) {
            $table->foreign('instrument_id')->references('id')->on('instruments');
            $table->foreign('metadata_id')->references('id')->on('metadata');
        });

        Schema::table('orders', function(Blueprint $table) {
            $table->foreign('portfolio_id')->references('id')->on('portfolios');
            $table->foreign('instrument_id')->references('id')->on('instruments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('portfolios', function(Blueprint $table) {
            $table->dropForeign('portfolios_user_id_foreign')->references('id')->on('users');
        });

        Schema::table('trades', function(Blueprint $table) {
            $table->dropForeign('trades_opponent_broker_id_foreign');
            $table->dropForeign('trades_instrument_id_foreign');
            $table->dropForeign('trades_position_id_foreign');
            $table->dropForeign('trades_order_id_foreign');
        });

        Schema::table('positions', function(Blueprint $table) {
            $table->dropForeign('positions_instrument_id_foreign');
            $table->dropForeign('positions_portfolio_id_foreign');
        });

        Schema::table('instruments', function(Blueprint $table) {
            $table->dropForeign('instruments_listing_id_foreign');
        });

        Schema::table('instruments_markets', function(Blueprint $table) {
            $table->dropForeign('instruments_markets_instrument_id_foreign');
            $table->dropForeign('instruments_markets_market_id_foreign');
        });

        Schema::table('instruments_metadata', function(Blueprint $table) {
            $table->dropForeign('instruments_metadata_instrument_id_foreign');
            $table->dropForeign('instruments_metadata_metadata_id_foreign');
        });

        Schema::table('orders', function(Blueprint $table) {
            $table->dropForeign('orders_portfolio_id_foreign');
            $table->dropForeign('orders_instrument_id_foreign');
        });
    }
}
