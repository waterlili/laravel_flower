<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCombinationFlowersToFlowerPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flower_packages', function (Blueprint $table) {
            $table->text('combination_flowers', 255)->after('has_leaf')->nullable();
            $table->timestamp('deleted_at')->after('updated_at')->default(Null);
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
            $table->dropColumn('combination_flowers', 'deleted_at');
        });
    }
}
