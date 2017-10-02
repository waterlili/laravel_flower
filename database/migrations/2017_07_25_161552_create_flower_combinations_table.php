<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowerCombinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flower_combinations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('package_id');
//            $table->string('flowers');//serialized array of flowers id - next table is instead this;
            $table->timestamps();

            $table->foreign('package_id')->references('id')->on('flower_packages');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('flower_combinations');
    }
}
