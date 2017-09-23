<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderListTable extends Migration {

	public function up()
	{
		Schema::create('order_list', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('pid')->unsigned();
			$table->integer('oid')->unsigned();
			$table->integer('price')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('order_list');
	}
}