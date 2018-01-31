<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFbUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fb_users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('fbid');
			$table->string('fullname');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('email');
			$table->string('gender');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fb_users');
	}

}
