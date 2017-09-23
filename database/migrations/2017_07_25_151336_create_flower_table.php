<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flowers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('nemad');
            $table->enum('vahed', ['shakhe', 'daste']);
            $table->double('price')->default('0');
            $table->enum('rade', ['arzan', 'geran']);
            $table->boolean('has_boo')->default('0');
            $table->enum('saghe', ['kootah', 'motvaset', 'boland']);
            $table->enum('mandegari', ['kam', 'motvaset', 'ziad']);

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
        Schema::drop('flowers');
    }
}
