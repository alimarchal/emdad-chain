<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('draft_purchase_order_id')->nullable()->index();
            $table->string('delivery_note_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('business_id')->nullable();
            $table->string('item_code')->nullable();
            $table->string('item_name')->nullable();
            $table->string('packing')->nullable();
            $table->string('brand')->nullable();
            $table->string('quantity')->nullable();
            $table->string('unit_price')->nullable();
            $table->string('rfq_no')->nullable();
            $table->string('rfq_item_no')->nullable();
            $table->string('qoute_no')->nullable();
            $table->string('payment_term')->nullable();
            $table->string('supplier_user_id')->nullable();
            $table->string('supplier_business_id')->nullable();
            $table->string('shipment_cost')->nullable();
            $table->string('total_cost')->nullable();
            $table->string('vat')->nullable();
            $table->string('otp')->nullable();
            $table->string('warehouse_coordinates')->nullable();
            $table->string('destination_coordinates')->nullable();
            $table->string('delivery_return')->nullable();
            $table->text('shipment_status')->nullable();
            $table->string('delivery_address')->nullable();
            $table->boolean('review_status')->default(0);
            $table->boolean('driver_rating')->default(0);
            $table->boolean('buyer_rating')->default(0);
            $table->boolean('supplier_rating')->default(0);
            $table->boolean('emdad_buyer_rating')->default(0);
            $table->boolean('emdad_supplier_rating')->default(0);
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
        Schema::dropIfExists('deliveries');
    }
}
