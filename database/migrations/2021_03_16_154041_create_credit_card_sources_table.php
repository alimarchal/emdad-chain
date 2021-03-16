<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditCardSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_card_sources', function (Blueprint $table) {
            $table->id();
            // payment_id from moyasar payment
            $table->string('payment_id')->unique();
            // type of payment, creditcard.
            $table->string('type');
            // credit card’s company mada or visa or master
            $table->string('company');
            // credit card’s holder name
            $table->string('name');
            // credit card’s masked number
            $table->string('number');
            // payment gateway message
            $table->string('message');
            // URL to complete 3-D secure transaction authorization at bank gateway
            $table->string('transaction_url');
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
        Schema::dropIfExists('credit_card_sources');
    }
}
