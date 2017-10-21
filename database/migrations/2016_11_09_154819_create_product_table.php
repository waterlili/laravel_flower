<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductTable extends Migration
{

    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->unsigned();
            $table->string('code', 40)->nullable();
            $table->string('title', 40);
            $table->string('description', 140)->nullable();
            $table->text('body')->nullable();
            $table->integer('price')->nullable();
            $table->tinyInteger('pack_type')->nullable();
            $table->boolean('is_active')->nullable();
            $table->integer('thumb')->unsigned();
            $table->integer('sales');
            $table->tinyInteger('sts')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('uid')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::drop('product');
    }
}