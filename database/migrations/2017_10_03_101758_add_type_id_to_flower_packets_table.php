<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeIdToFlowerPacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flower_packets', function (Blueprint $table) {
            $table->integer('type_id')->unsigned()->after('id');
            $table->foreign('type_id')->references('id')->on('packet_types')
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
        Schema::table('flower_packets', function (Blueprint $table) {
            $table->dropForeign('flower_packets_type_id_foreign');
            $table->dropColumn('type_id');

        });
    }
}
