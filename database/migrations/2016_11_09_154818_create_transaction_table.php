<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionTable extends Migration {

	public function up()
	{
		Schema::create('transaction', function(Blueprint $table) {
			$table->increments('id');
			$table->string('code')->nullable();
			$table->tinyInteger('sts')->nullable();
			$table->tinyInteger('bank')->nullable();
			$table->timestamp('send_at')->nullable();
			$table->integer('price')->nullable();
			$table->string('response_code', 100)->nullable();
			$table->boolean('has_error')->nullable();
			$table->integer('order')->unsigned();
			$table->integer('cid')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('transaction');
	}
}