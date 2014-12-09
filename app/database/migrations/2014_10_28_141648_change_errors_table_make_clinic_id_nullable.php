<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeErrorsTableMakeClinicIdNullable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('errors', function($table) {

			// drop the old key
            $table->dropForeign('errors_clinic_id_foreign');

            // alter the table to make clinic_id nullable
			DB::statement('ALTER TABLE errors MODIFY COLUMN clinic_id INT(10) UNSIGNED NULL DEFAULT NULL');

            // add back in the foreign key constraint
			$table->foreign('clinic_id')->references('id')->on('clinic');
        }); 
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
