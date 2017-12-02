<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSentAtToOrderPacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_packets', function (Blueprint $table) {
            $table->tinyInteger('period')->after('packet_id');
            $table->dateTime('sent_at')->after('combination');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_packets', function (Blueprint $table) {
            $table->dropColumns('sent_at', 'period');
        });
    }
}
