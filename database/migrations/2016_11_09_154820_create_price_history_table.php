<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePriceHistoryTable extends Migration
{

    public function up()
    {
        Schema::create('price_history', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('price');
            $table->integer('pid')->unsigned();
            $table->foreign('pid')->references('id')->on('product')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::drop('price_history');
    }
}