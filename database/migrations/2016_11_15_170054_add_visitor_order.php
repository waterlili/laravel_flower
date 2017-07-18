<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVisitorOrder extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('order', function (Blueprint $table) {
      $table->integer('visitor')->unsigned()->nullable();
      $table->integer('sender')->unsigned()->nullable();

      $table->foreign('visitor')->references('id')->on('users')
        ->onDelete('cascade')
        ->onUpdate('cascade');
      
      $table->foreign('sender')->references('id')->on('users')
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
    Schema::table('order', function (Blueprint $table) {
      //
    });
  }
}
