<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoyasarPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moyasar_payments', function (Blueprint $table) {
            $table->id();
            // payment’s unique ID.
            $table->string('payment_id')->unique();
            // payment status. (default: initiated)
            $table->string('status')->default('initiated');
            // payment amount in halals.
            $table->decimal('amount',2);
            // transaction fee in halals.
            $table->decimal('fee',2);
            // 3 currency code iso alpha payment currency. (default: SAR)
            $table->string('currency',3)->default('SAR');
            // refunded amount in halals. (default: 0)
            $table->integer('refunded')->default(0);
            // datetime of refunded. (default: null)
            $table->timestamp('refunded_at')->nullable();
            // captured amount in halals. (default: 0)
            $table->integer('captured')->default(0);
            // datetime of authroized payment captured. (default: null)
            $table->string('captured_at')->nullable();
            // datetime of voided. (default: null)
            $table->string('voided_at')->nullable();
            // payment description
            $table->string('description')->nullable();
            // ID of the invoice this payment is for if one exists.(default: null)
            $table->string('invoice_id')->nullable();
            // User IP
            $table->string('ip')->nullable();
            // page url in customer’s site for final redirection. (used for creditcard 3-D secure and form payment)
            $table->string('callback_url')->nullable();
            // json source object defined the type of payment.
            $table->text('source')->nullable();
//            $table->string('type')->nullable();
//            $table->string('company')->nullable();
//            $table->string('name')->nullable();
//            $table->string('number')->nullable();
//            $table->string('message')->nullable();
//            $table->string('transaction_url')->nullable();
            // created_at creation timestamp in ISO 8601 format.
            // updated_at modification timestamp in ISO 8601 format..
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
        Schema::dropIfExists('moyasar_payments');
    }
}
