<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageFlowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_flowers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('package_id');
            $table->unsignedInteger('flower_id');
            $table->unsignedInteger('count');

            $table->foreign('package_id')->references('id')->on('flower_packages')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('flower_id')->references('id')->on('flowers')->onDelete('cascade')
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
        Schema::drop('package_flowers');
    }
}
