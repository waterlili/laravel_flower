<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

  public function up() {
    Schema::create('users', function (Blueprint $table) {
      $table->increments('id');
      $table->string('fname', 50)->nullable();
      $table->string('lname', 50)->nullable();
      $table->string('email', 100)->nullable();
      $table->tinyInteger('type');
      $table->string('username', 100);
      $table->string('password', 60);
      $table->timestamp('last_login');
      $table->boolean('active')->nullable();
      $table->string('rememberToken', 100);
      $table->tinyInteger('sts')->nullable();
      $table->string('personal_picture')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  public function down() {
    Schema::drop('users');
  }
}