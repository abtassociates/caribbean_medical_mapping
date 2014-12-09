<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixProprietorInfoJobCategoryEntries extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$records = ProprietorInformation::where('jobcat', '=', 'Pharmacy Technicial')->get();
        foreach($records as $record){
            $record->jobcat = "Pharmacy Technician";
            $record->save();
        }

		$records = ProprietorInformation::where('jobcat', '=', 'Lab Technicial')->get();
        foreach($records as $record){
            $record->jobcat = "Lab Technician";
            $record->save();
        }

		$records = ProprietorInformation::where('jobcat', '=', 'Physician - general practicioner')->get();
        foreach($records as $record){
            $record->jobcat = "Physician - general practitioner";
            $record->save();
        }

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
