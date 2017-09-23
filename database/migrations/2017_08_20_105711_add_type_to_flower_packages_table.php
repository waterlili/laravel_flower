<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToFlowerPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flower_packages', function (Blueprint $table) {
            $table->enum('type', [
                'normal',
                'luxury',
                'managerial'
            ])->after('combination_flowers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flower_packages', function (Blueprint $table) {
            $table->removeColumn('type');
        });
    }
}
