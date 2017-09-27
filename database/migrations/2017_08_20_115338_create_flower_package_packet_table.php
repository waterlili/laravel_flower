<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowerPackagePacketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flower_package_packet', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('flower_package_id');
            $table->unsignedInteger('packet_id');
            $table->timestamps();

            $table->foreign('flower_package_id')->references('id')->on('flower_packages');
            $table->foreign('packet_id')->references('id')->on('packets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('flower_package_packet');
    }
}
