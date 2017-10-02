<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_day', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('oid')->unsigned();
            $table->integer('cid')->unsigned();
            $table->integer('prc')->unsigned();
            $table->timestamp('when');
            $table->tinyInteger('count');
            $table->tinyInteger('w');
            $table->tinyInteger('total');
            $table->tinyInteger('sts');
            $table->tinyInteger('type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_day');
    }
}
