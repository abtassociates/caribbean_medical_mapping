<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSectorListTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// create the schema
		Schema::create('sector_list', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('sectorvalue');
			$table->string('sector');
			$table->timestamps();
		});

		// put in its few rows
		DB::table('sector_list')->insert(array(
			array("sectorvalue"=>"All Providers", "sector"=>"All Providers"),
			array("sectorvalue"=>"Public Sector Provider", "sector"=>"Public Sector Providers"),
			array("sectorvalue"=>"Private Sector Provider", "sector"=>"Private Sector Providers"),
			array("sectorvalue"=>"Natural/Homeopathic Sector Provider", "sector"=>"Natural/Homeopathic Sector Providers")
		));
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sector_list');
	}

}
