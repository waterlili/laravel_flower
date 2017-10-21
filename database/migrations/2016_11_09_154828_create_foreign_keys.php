<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('user_info', function(Blueprint $table) {
			$table->foreign('uid')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('transaction', function(Blueprint $table) {
			$table->foreign('order')->references('id')->on('order')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('transaction', function(Blueprint $table) {
			$table->foreign('cid')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('order', function(Blueprint $table) {
			$table->foreign('uid')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('order', function(Blueprint $table) {
			$table->foreign('creator')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('options', function(Blueprint $table) {
			$table->foreign('uid')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('product', function(Blueprint $table) {
			$table->foreign('uid')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('order_list', function(Blueprint $table) {
			$table->foreign('pid')->references('id')->on('product')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('order_list', function(Blueprint $table) {
			$table->foreign('oid')->references('id')->on('order')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('price_history', function(Blueprint $table) {
			$table->foreign('pid')->references('id')->on('product')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('user_info', function(Blueprint $table) {
			$table->dropForeign('user_info_uid_foreign');
		});
        Schema::table('transaction', function (Blueprint $table) {
            $table->dropForeign('transaction_order_foreign');
        });
		Schema::table('transaction', function(Blueprint $table) {
			$table->dropForeign('transaction_cid_foreign');
		});
		Schema::table('order', function(Blueprint $table) {
			$table->dropForeign('order_uid_foreign');
		});
		Schema::table('order', function(Blueprint $table) {
			$table->dropForeign('order_creator_foreign');
		});
		Schema::table('options', function(Blueprint $table) {
			$table->dropForeign('options_uid_foreign');
		});
		Schema::table('product', function(Blueprint $table) {
			$table->dropForeign('product_uid_foreign');
		});
		Schema::table('order_list', function(Blueprint $table) {
			$table->dropForeign('order_list_pid_foreign');
		});
		Schema::table('order_list', function(Blueprint $table) {
			$table->dropForeign('order_list_oid_foreign');
		});
		Schema::table('price_history', function(Blueprint $table) {
			$table->dropForeign('price_history_pid_foreign');
		});
	}
}