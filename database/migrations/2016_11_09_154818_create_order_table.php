<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderTable extends Migration {

	public function up()
	{
		Schema::create('order', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('price');
			$table->integer('uid')->unsigned();
			$table->tinyInteger('type')->nullable();
			$table->tinyInteger('when')->nullable();
			$table->tinyInteger('day')->nullable();
			$table->tinyInteger('total_product')->nullable();
			$table->boolean('automate')->nullable();
			$table->integer('creator')->unsigned()->nullable();
			$table->string('description')->nullable();
			$table->timestamp('closed_at')->nullable();
			$table->boolean('closed')->nullable();
			$table->text('feedback')->nullable();
			$table->tinyInteger('sts')->nullable();
			$table->tinyInteger('submit')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('order');
	}
}