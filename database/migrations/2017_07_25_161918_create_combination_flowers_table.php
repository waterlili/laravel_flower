<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombinationFlowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combination_flowers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('flower_combination_id');
            $table->unsignedInteger('flower_id');
            $table->unsignedInteger('order');
            $table->timestamps();

            $table->foreign('flower_id')->references('id')->on('flowers');
            $table->foreign('flower_combination_id')->references('id')->on('flower_combinations');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('combination_flowers');
    }
}
