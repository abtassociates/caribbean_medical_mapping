<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFacilityTermFieldToInstance extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('instance', function($table) {
			$new_facility_term = "facility";
			$table->string('facility_term')->default('facility');
			Clinic::update_facility_term_dependent_responses($new_facility_term);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('instance', function($table) {
			$table->dropColumn('facility_term');
		});
	}

}
