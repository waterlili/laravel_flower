<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PayTypeOrder extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('order', function (Blueprint $table) {
      $table->tinyInteger('pay_type')->nullable();
      $table->timestamp('send_at')->nullable();
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
