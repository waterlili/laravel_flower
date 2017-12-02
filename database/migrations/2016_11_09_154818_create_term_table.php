<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTermTable extends Migration {

	public function up()
	{
		Schema::create('term', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 40);
			$table->string('description', 255)->nullable();
			$table->integer('parent')->nullable();
			$table->integer('count')->nullable();
			$table->tinyInteger('sts')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('term');
	}
}