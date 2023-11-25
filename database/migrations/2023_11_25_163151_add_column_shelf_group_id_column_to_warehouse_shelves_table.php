<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('warehouse_shelves', function (Blueprint $table) {

            $table->unsignedBigInteger('shelf_group_id')->nullable(); // user_id
            $table->foreign('shelf_group_id')->references('id')->on('warehouse_shelf_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehouse_shelves', function (Blueprint $table) {
            $table->dropColumn('shelf_group_id');
        });
    }
};
