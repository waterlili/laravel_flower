<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompositTable extends Migration {

	public function up()
	{
		Schema::create('composit', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 50)->nullable();
			$table->tinyInteger('total')->nullable();
			$table->tinyInteger('level')->nullable();
			$table->string('session', 20)->nullable();
			$table->tinyInteger('p_level')->nullable();
			$table->string('exp')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('composit');
	}
}