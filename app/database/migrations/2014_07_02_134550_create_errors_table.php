<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErrorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('errors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();

			$table->integer('clinic_id')->unsigned();
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->longText('issue');
			$table->dateTime('resolved_on')->nullable()->default(null);
			$table->integer('resolved_by')->unsigned()->nullable()->default(null);

			$table->foreign('clinic_id')->references('id')->on('clinic');
			$table->foreign('resolved_by')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('errors');
	}

}
