<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderPacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_packets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('packet_id')->unsigned();
            $table->string('combination');
            $table->tinyInteger('type');
            $table->dateTime('send_at')->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')
                ->onUpdate('cascade');
            $table->foreign('packet_id')->references('id')->on('flower_packets')
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
        Schema::drop('order_packets');
    }
}