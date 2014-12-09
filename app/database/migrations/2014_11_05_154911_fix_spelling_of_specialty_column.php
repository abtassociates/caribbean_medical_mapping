<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixSpellingOfSpecialtyColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('clinic', function($table)
		{
		    // add new spelling
			$table->string('specialty');
		});


		// move over values
		foreach(Clinic::all() as $clinic){
			$clinic->specialty = $clinic->speciality;
			$clinic->save();
		}

		Schema::table('clinic', function($table)
		{
			// drop old spelling
			$table->dropColumn('speciality');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('clinic', function($table)
		{
		    // add new spelling
			$table->string('speciality');
		});


		// move over values
		foreach(Clinic::all() as $clinic){
			$clinic->speciality = $clinic->specialty;
			$clinic->save();
		}

		Schema::table('clinic', function($table)
		{
			// drop old spelling
			$table->dropColumn('specialty');
		});
	}

}
