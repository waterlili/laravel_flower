<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableGroup extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('group', function (Blueprint $table) {
      $table->increments('id');
      $table->string('title', 40);
      $table->integer('parent')->nullable();
      $table->tinyInteger('depth');
    });
    Schema::create('customer_group', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('group')->unsigned();
      $table->integer('customer')->unsigned();

      $table->foreign('group')->references('id')->on('group')
        ->onDelete('cascade')
        ->onUpdate('cascade');

      $table->foreign('customer')->references('id')->on('users')
        ->onDelete('cascade')
        ->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('group');
  }
}
