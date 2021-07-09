<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('delivery_id')->nullable();
            $table->string('rfq_no')->nullable();
            $table->string('rfq_item_no')->nullable();
            $table->string('qoute_no')->nullable();
            $table->string('draft_purchase_order_id')->nullable();
            $table->string('buyer_user_id')->nullable();
            $table->string('buyer_business_id')->nullable();
            $table->string('supplier_user_id')->nullable();
            $table->string('supplier_business_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('shipment_cost')->nullable();
            $table->string('vat')->nullable();
            $table->string('total_cost')->nullable();
            $table->string('invoice_status')->nullable();
            $table->string('invoice_type')->nullable();
            $table->integer('rfq_type'); /* 0 for single category RFQ, 1 for multi categories */
            $table->string('invoice_cash_online')->nullable();
            $table->string('ship_to_address')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
