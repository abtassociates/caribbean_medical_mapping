<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMetaDescriptionFieldToSettings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('instance', function($table) {
			$table->text('meta_description');
		});

		$instance = Instance::get();

		$instance->meta_description = "Comprehensive listing of health facilities, including services available, hours of operation, location, type of provider, and specialist.";
		$instance->save();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('instance', function($table) {
			$table->dropColumn('meta_description');
		});
	}

}
