<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOptionsTable extends Migration
{

    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key', 100);
            $table->binary('value');
            $table->integer('uid')->unsigned();
            $table->tinyInteger('type')->nullable();
            $table->timestamps();
            $table->foreign('uid')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::drop('options');
    }
}