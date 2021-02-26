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
            $table->string('delivery_id')->nullable()->index();;
            $table->string('rfq_no')->nullable()->index();;
            $table->string('rfq_item_no')->nullable()->index();;
            $table->string('qoute_no')->nullable()->index();;
            $table->string('draft_purchase_order_id')->nullable()->index();;
            $table->string('buyer_user_id')->nullable()->index();;
            $table->string('buyer_business_id')->nullable()->index();;
            $table->string('supplier_user_id')->nullable()->index();;
            $table->string('supplier_business_id')->nullable()->index();;
            $table->string('shipment_cost')->nullable()->index();;
            $table->string('total_cost')->nullable()->index();;
            $table->string('vat')->nullable()->index();;
            $table->string('payment_method');
            $table->string('ship_to_address');
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
