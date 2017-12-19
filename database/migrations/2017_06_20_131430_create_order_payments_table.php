<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->increments('id');
            //each orders has a payments
            $table->integer('oid')->unsigned();
            $table->tinyInteger('type')->nullable();
            $table->tinyInteger('sts')->nullable()->default('0');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('oid')->references('id')->on('orders')
                ->onDelete('cascade')
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
        Schema::drop('order_payments');
    }
}
