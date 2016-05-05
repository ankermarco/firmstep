<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('service_name');
			$table->timestamps();
		});

		Schema::create('queue', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('customer_type');
			$table->string('name');
			$table->integer('service_id')->unsigned();
			$table->timestamps();

			$table->foreign('service_id')->references('id')->on('service');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('queue');
		Schema::drop('service');
	}

}
