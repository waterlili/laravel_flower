<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserInfoTable extends Migration
{

    public function up()
    {
        Schema::create('user_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->unsigned();
            $table->string('job', 50)->nullable();
            $table->tinyInteger('job_type')->nullable();
            $table->string('skill')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('zip_code', 13)->nullable();
            $table->string('phone', 13)->nullable();
            $table->string('mobile', 13)->nullable();
            $table->tinyInteger('sts')->nullable();
            $table->string('softDeletes', 50)->nullable();
            $table->timestamps();

            $table->foreign('uid')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::drop('user_info');
    }
}