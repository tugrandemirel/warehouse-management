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
        Schema::table('product_options', function (Blueprint $table) {
            $table->unsignedBigInteger('measurement_unit_id')->nullable()->after('currency_id');
            $table->foreign('measurement_unit_id')->references('id')->on('measurement_units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_options', function (Blueprint $table) {
            $table->dropForeign(['measurement_unit_id']);
            $table->dropColumn('measurement_unit_id');
        });
    }
};
