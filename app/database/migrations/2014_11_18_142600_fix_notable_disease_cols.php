<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixNotableDiseaseCols extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('ALTER TABLE health_records_and_reporting MODIFY COLUMN reportnotedis tinyint(1) DEFAULT NULL');
		DB::statement('ALTER TABLE health_records_and_reporting MODIFY COLUMN recipnotedis VARCHAR(100) DEFAULT NULL');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('ALTER TABLE health_records_and_reporting MODIFY COLUMN reportnotedis VARCHAR(100) DEFAULT NULL');
		DB::statement('ALTER TABLE health_records_and_reporting MODIFY COLUMN recipnotedis tinyint(1) DEFAULT NULL');
	}

}
