<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('seller_no')->unique()->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('gender');
            $table->string('nid_num');
            $table->string('referred_no')->nullable();
            $table->bigInteger('type');
            $table->string('mobile_number');
            $table->string('status')->default(1);
            $table->bigInteger('rtl')->default(0);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sellers');
    }
}
