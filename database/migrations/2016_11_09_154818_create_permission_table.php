<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionTable extends Migration {

	public function up()
	{
		Schema::create('permission', function(Blueprint $table) {
			$table->increments('id');
			$table->tinyInteger('utid');
			$table->bigInteger('rid');
			$table->tinyInteger('sts')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('permission');
	}
}