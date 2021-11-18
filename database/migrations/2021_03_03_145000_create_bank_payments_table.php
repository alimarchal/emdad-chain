<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_payments', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id', 30)->nullable();
            $table->string('proforma_invoice_id', 30)->nullable();
            $table->string('draft_purchase_order_id', 30)->nullable();
            $table->string('quote_no', 30)->nullable();
            $table->integer('rfq_no')->nullable();
            $table->string('bank_name', 30)->nullable();
            $table->string('amount_received', 30)->nullable();
            $table->string('amount_date', 30)->nullable();
            $table->string('verified_status', 30)->nullable();
            $table->string('verified_by', 30)->nullable();
            $table->string('supplier_business_id', 30)->nullable();
            $table->string('supplier_user_id', 30)->nullable();
            $table->string('buyer_business_id', 30)->nullable();
            $table->string('buyer_user_id', 30)->nullable();
            $table->integer('supplier_payment_status')->default(0);
            $table->string('status', 30)->nullable();
            $table->integer('rfq_type');                             /* 0 for single category RFQ, 1 for multi categories */
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
        Schema::dropIfExists('bank_payments');
    }
}
