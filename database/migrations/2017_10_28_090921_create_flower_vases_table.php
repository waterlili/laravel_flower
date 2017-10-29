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
            $table->string('material')->nullable();
            $table->string('quality')->nullable();
            $table->string('capacity')->nullable();
            $table->string('images', 500)->nullable();
            $table->decimal('price');
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
        Schema::drop('flower_vases');
    }
}
