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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->string("name", 100);
            $table->string("degree")->nullable();
            $table->string("tax_administration")->nullable();
            $table->string("tax_number")->nullable();
            $table->string("room_registration_number")->nullable();
            $table->text("description")->nullable();
            $table->string("phone", 20)->nullable();
            $table->string("email", 100)->nullable();
            $table->string("website", 100)->nullable();
            $table->string("address")->nullable();
            $table->string("post_code", 20)->nullable();
            $table->boolean("is_active")->default(1);
            $table->string("logo")->nullable();
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
        Schema::dropIfExists('companies');
    }
};
