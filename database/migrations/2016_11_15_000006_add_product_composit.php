<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductComposit extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('composit', function (Blueprint $table) {
      $table->integer('product')->unsigned();
      $table->integer('flower')->unsigned();
      $table->foreign('product')->references('id')->on('product')
        ->onDelete('cascade')
        ->onUpdate('cascade');
        $table->foreign('flower')->references('id')->on('flowers')
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
    Schema::table('composit', function (Blueprint $table) {
      //
    });
  }
}
