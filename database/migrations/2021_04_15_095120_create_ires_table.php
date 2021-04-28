<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ires', function (Blueprint $table) {
            $table->id();
            $table->string('ire_no')->unique()->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->dateTime('email_verified_at')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('verify_token')->nullable();
            $table->integer('verified')->nullable();
            $table->string('gender')->nullable();
            $table->bigInteger('bank')->nullable();
            $table->string('iban')->nullable();
            $table->string('nid_num')->nullable();
            $table->string('nid_image')->nullable();
            $table->string('referred_no')->nullable();
            $table->bigInteger('type')->nullable();
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
        Schema::dropIfExists('ires');
    }
}
