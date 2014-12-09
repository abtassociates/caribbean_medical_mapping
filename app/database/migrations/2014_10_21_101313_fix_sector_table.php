<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixSectorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		//get rid of old unneeded table
		Schema::drop('sector_list');

		//create a better normalized sectors table
		Schema::create('sectors', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('name');
		});

		//seed sectors table with all existant values in facilities
		$sectors = array("Public Sector Provider", "Private Sector Provider");
		$rows = DB::table('clinic')->select('sector')->groupBy('sector')->get();
		foreach($rows as $row){
			$sector = trim($row->sector);
			if($sector){$sectors[] = $sector;}
		}
		$sectors = array_unique($sectors);
		$inserts = array();
		foreach($sectors as $sector){
			$s = Sector::create(array('name' => $sector));
			$inserts[$s->name] = $s->id;
		}

		// add column sector_id to clinic table
		Schema::table('clinic', function($table){
			$table->unsignedInteger('sector_id')->nullable()->default(null);
			$table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
		});
		

		// insert that value as needed
		foreach(Clinic::all() as $clinic){
			if($clinic->sector){
				$clinic->sector_id = $inserts[$clinic->sector];
				$clinic->save();
			}
		}

		//remove old sector column
		Schema::table('clinic',function($table){
			$table->dropColumn('sector');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		Schema::table('clinic',function($table){
			$table->dropForeign('clinic_sector_id_foreign');
			$table->dropColumn('sector_id');
		});

		Schema::drop('sectors');

		Schema::create('sector_list', function(Blueprint $table)
		{
			$table->increments('id');
		});
	}

}
