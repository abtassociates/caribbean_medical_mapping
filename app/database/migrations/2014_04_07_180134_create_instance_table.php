<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('instance', function(Blueprint $table)
		{
			$table->increments('id');

			// theme
			$table->string("country")->nullable();
			$table->string("main_color")->nullable();
			$table->string("accent_color")->nullable();
			$table->string("logo")->nullable()->default(null);

			// settings
			$table->string("google_analytics_key")->nullable()->default(null);
			$table->string("google_maps_key")->nullable()->default(null);
			$table->decimal("map_lat", 13, 10)->nullable()->default(null);
			$table->decimal("map_lng", 13, 10)->nullable()->default(null);
			$table->float("map_distance_x", 13, 10)->nullable()->default(null);
			$table->float("map_distance_y", 13, 10)->nullable()->default(null);
		});

	    // put in three to start
	    DB::table('instance')->insert(array(
	      "country" => "Country Name",
	      "main_color" => "#757575",
	      "accent_color" => "#C0E2CC",
	      "logo" => "",

	      "google_maps_key" => "",
	      "map_lat" => "14.80674937215846",
	      "map_lng" => "-61.13342285159689",
	      "map_distance_x" => "7.8125",
	      "map_distance_y" => "4.6875"
	    ));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('instance');
	}

}
