<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
//            $table->integer('pk_id')->unsigned();
            $table->integer('itemable_id');
            $table->string('itemable_type');
            $table->tinyInteger('sts');
            $table->integer('count')->nullable();
            $table->string('combination', 255)->nullable();
            $table->tinyInteger('period');
            $table->string('text', 300)->nullable();
            $table->dateTime('sent_at')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
//            $table->foreign('pk_id')->references('id')->on('flower_packets')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_items');
    }
}
