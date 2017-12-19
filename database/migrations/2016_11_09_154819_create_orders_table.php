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
            //define vase
            $table->integer('vid')->unsigned()->nullable()->default(0);
            $table->tinyInteger('type');
            //type2 is for diagnose flower or packet
            $table->tinyInteger('type2');
            $table->tinyInteger('sts')->default(1);
            $table->double('amount')->default(0);
            $table->integer('sent_count')->default(0);
            $table->tinyInteger('time_duration')->nullable();
            $table->tinyInteger('daysOfWeek')->nullable();
            $table->tinyInteger('month')->nullable();
            $table->tinyInteger('sending')->nullable();
            $table->string('sending_name', 50)->nullable();
            $table->string('sending_mobile', 15)->nullable();
            $table->string('sending_address')->nullable();
            $table->dateTime('started_at')->nullable()->default(null);
            $table->dateTime('expired_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('cid')->references('id')->on('customers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('vid')->references('id')->on('flower_vases')
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
