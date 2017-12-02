<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomerAttraction extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('user_info', function (Blueprint $table) {
      $table->tinyInteger('att_type')->nullable();
      $table->string('attraction', 20)->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('user_info', function (Blueprint $table) {
      //
    });
  }
}
