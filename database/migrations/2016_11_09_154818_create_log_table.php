<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogTable extends Migration {

	public function up()
	{
		Schema::create('log', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('uid')->unsigned();
			$table->tinyInteger('type')->nullable();
			$table->string('message', 100)->nullable();
			$table->binary('data')->nullable();
			$table->tinyInteger('severity')->nullable();
			$table->string('hostname', 15)->nullable();
			$table->string('location', 20)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('log');
	}
}