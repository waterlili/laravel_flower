<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CostTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('cost', function (Blueprint $table) {
      $table->increments('id');
      $table->string('title')->nullbale();
      $table->string('paraph')->nullbale();
      $table->string('description')->nullable();
      $table->bigInteger('price');
      $table->string('type', 20)->nullbale();
      $table->integer('uid')->unsigned()->nullbale();
      $table->integer('reviewer')->unsigned()->nullbale();
      $table->integer('parent')->unsigned()->nullbale();
      $table->tinyInteger('sts');
      $table->timestamps();


      $table->foreign('uid')->references('id')->on('users')
        ->onDelete('cascade')
        ->onUpdate('cascade');

      $table->foreign('reviewer')->references('id')->on('users')
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
    Schema::drop('cost');
  }
}
