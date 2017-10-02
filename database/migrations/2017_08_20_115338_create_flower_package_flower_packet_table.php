<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowerPackageFlowerPacketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flower_package_flower_packet', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('flower_package_id');
            $table->unsignedInteger('flower_packet_id');
            $table->timestamps();

            $table->foreign('flower_package_id')->references('id')->on('flower_packages');
            $table->foreign('flower_packet_id')->references('id')->on('packets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('flower_package_flower_packet');
    }
}
