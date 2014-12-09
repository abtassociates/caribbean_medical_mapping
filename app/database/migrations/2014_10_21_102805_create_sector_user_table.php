<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectorUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sector_user', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			
			$table->unsignedInteger('sector_id');
			$table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
			
			$table->unsignedInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sector_user');
	}

}
