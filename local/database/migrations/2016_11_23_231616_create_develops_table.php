<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevelopsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('develops', function(Blueprint $table)
		{
			$table->string('id')->unique();
			$table->string('appname')->nullable();
			$table->string('title')->nullable();
			$table->string('description')->nullable();
			$table->string('img')->nullable();
			$table->json('results')->nullable();
			$table->json('appset')->nullable();
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
		Schema::drop('develops');
	}

}
