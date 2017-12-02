<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowerVasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flower_vases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->tinyInteger('material')->nullable();
            $table->integer('weight')->nullable();
            $table->tinyInteger('size')->nullable();
            $table->tinyInteger('quality')->nullable();
            $table->string('capacity')->nullable();
            $table->integer('color_id')->unsigned()->nullable();
            $table->string('images', 500)->nullable();
            $table->double('price')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('color_id')->references('id')->on('consts');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('flower_vases');
    }
}
