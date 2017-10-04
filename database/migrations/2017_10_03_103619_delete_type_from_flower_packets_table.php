<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteTypeFromFlowerPacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flower_packets', function (Blueprint $table) {
            $table->dropColumn('type', 'name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flower_packets', function (Blueprint $table) {
            $table->string('name', 255)->after('id');
            $table->string('type', 255)->after('name');
        });
    }
}
