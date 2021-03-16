<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplePaySourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apple_pay_sources', function (Blueprint $table) {
            $table->id();
            // payment_id from moyasar payment
            $table->string('payment_id')->unique();
            // type of payment, creditcard.
            $table->string('type');
            // type of payment, applepay.
            $table->string('token');
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
        Schema::dropIfExists('apple_pay_sources');
    }
}
