<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderListTable extends Migration
{

    public function up()
    {
        Schema::create('order_list', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->unsigned();
            $table->integer('oid')->unsigned();
            $table->integer('price')->nullable();
            $table->foreign('pid')->references('id')->on('product')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('oid')->references('id')->on('orders')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::drop('order_list');
    }
}