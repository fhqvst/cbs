<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChangeToStocks extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('stocks', function($table)
        {
            $table->double('change');
            $table->double('change_percent');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('stocks', function($table)
        {
            $table->dropColumn(['change', 'change_percent']);
        });
	}

}
