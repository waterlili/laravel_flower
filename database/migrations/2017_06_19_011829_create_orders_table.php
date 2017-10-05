<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cid')->unsigned();
            $table->tinyInteger('type');
            $table->tinyInteger('time')->nullable();
            $table->tinyInteger('daysOfWeek')->nullable();
            $table->tinyInteger('sending')->nullable();
            $table->tinyInteger('month')->nullable();
            $table->string('sending_name', 50)->nullable();
            $table->string('sending_mobile', 15)->nullable();
            $table->string('sending_address')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('cid')->references('id')->on('customers')
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
        Schema::drop('orders');
    }
}
