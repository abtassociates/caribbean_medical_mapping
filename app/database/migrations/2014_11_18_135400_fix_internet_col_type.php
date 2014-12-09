<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixInternetColType extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('ALTER TABLE staffing_and_equipment MODIFY COLUMN facinternet VARCHAR(255) DEFAULT NULL');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('ALTER TABLE staffing_and_equipment MODIFY COLUMN facinternet tinyint(1) DEFAULT NULL');
	}

}
