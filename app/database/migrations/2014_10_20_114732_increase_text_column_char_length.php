<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IncreaseTextColumnCharLength extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	  	DB::statement('ALTER TABLE clinic MODIFY COLUMN facilityname VARCHAR(255)');
	  	DB::statement('ALTER TABLE clinic MODIFY COLUMN facilityaddress VARCHAR(255)');

	  	DB::statement('ALTER TABLE proprietor_information MODIFY COLUMN assoc VARCHAR(255)');

	  	DB::statement('ALTER TABLE facility_information MODIFY COLUMN hournotes VARCHAR(255)');
	  	DB::statement('ALTER TABLE staffing_and_equipment MODIFY COLUMN empphysspectypes VARCHAR(255)');
		DB::statement('ALTER TABLE staffing_and_equipment MODIFY COLUMN empnotes VARCHAR(255)');
		DB::statement('ALTER TABLE staffing_and_equipment MODIFY COLUMN faccompotherspec VARCHAR(255)');

		DB::statement('ALTER TABLE service_availability_and_utilization MODIFY COLUMN hivoutother VARCHAR(255)');
		DB::statement('ALTER TABLE service_availability_and_utilization MODIFY COLUMN specialtyspec VARCHAR(255)');
		DB::statement('ALTER TABLE service_availability_and_utilization MODIFY COLUMN specialtyvisitspec VARCHAR(255)');
		DB::statement('ALTER TABLE service_availability_and_utilization MODIFY COLUMN requestspec VARCHAR(255)');
		DB::statement('ALTER TABLE service_availability_and_utilization MODIFY COLUMN referfacility VARCHAR(255)');
		DB::statement('ALTER TABLE service_availability_and_utilization MODIFY COLUMN referhowspec VARCHAR(255)');
		DB::statement('ALTER TABLE service_availability_and_utilization MODIFY COLUMN refertohowspec VARCHAR(255)');

		DB::statement('ALTER TABLE hiv_aids_services MODIFY COLUMN rapidtestspec VARCHAR(255)');

		DB::statement('ALTER TABLE laboratory_and_pharmacy_services MODIFY COLUMN cancerspec VARCHAR(255)');
		DB::statement('ALTER TABLE laboratory_and_pharmacy_services MODIFY COLUMN reagentsout VARCHAR(255)');
		DB::statement('ALTER TABLE laboratory_and_pharmacy_services MODIFY COLUMN diagout VARCHAR(255)');
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
