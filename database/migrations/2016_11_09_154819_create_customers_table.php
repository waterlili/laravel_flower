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
            $table->integer('job_id')->nullable()->unsigned();
            $table->integer('skill_id')->nullable()->unsigned();
            $table->integer('type_attraction_id')->nullable()->unsigned();
            $table->string('description')->nullable();
            $table->tinyInteger('sts');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('job_id')->references('id')->on('consts')
                ->onUpdate('cascade');
            $table->foreign('skill_id')->references('id')->on('consts')
                ->onUpdate('cascade');
            $table->foreign('type_attraction_id')->references('id')->on('consts')
                ->onUpdate('cascade');
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
