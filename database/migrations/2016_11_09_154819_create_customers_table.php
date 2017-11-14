<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname', 25);
            $table->string('lname', 25);
            $table->tinyInteger('gender')->nullable();
            $table->string('mobile', 15)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('address')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('job', 20)->nullable();
            $table->string('skill', 50)->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('type_attraction')->nullable();
            $table->tinyInteger('sts');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
