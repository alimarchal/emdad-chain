<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStcPaySourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stc_pay_sources', function (Blueprint $table) {
            $table->id();
            // payment_id from moyasar payment
            $table->string('payment_id')->unique();
            // type of payment, stcpay.
            $table->string('type');
            // Customer’s mobile number.
            $table->string('mobile');
            // STCPay’s payment reference.
            $table->string('reference_number');
            // Merchant branch ID.
            $table->string('branch');
            // cashier
            $table->string('cashier');
            // URL to confirm payment authorization.
            $table->string('transaction_url');
            // Response message.
            $table->string('message');
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
        Schema::dropIfExists('stc_pay_sources');
    }
}
