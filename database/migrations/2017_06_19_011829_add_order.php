<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type');
            $table->tinyInteger('time')->nullable();
            $table->timestamp('first')->nullable();
            $table->tinyInteger('week')->nullable();
            $table->tinyInteger('sending')->nullable();
            $table->tinyInteger('w')->nullable();
            $table->string('sending_name', 50)->nullable();
            $table->string('sending_mobile', 15)->nullable();
            $table->string('sending_address')->nullable();
            $table->integer('prc')->unsigned();
            $table->integer('cid')->unsigned();
            $table->integer('uid')->unsigned();
            $table->mediumInteger('total')->nullable();
            $table->tinyInteger('pay_type')->nullable();
            $table->integer('price')->nullable();
            $table->string('bank')->nullable();
            $table->string('no')->nullable();
            $table->tinyInteger('sts')->nullable();
            $table->softDeletes();
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
        Schema::drop('order');
    }
}
