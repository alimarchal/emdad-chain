<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDraftPurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draft_purchase_orders', function (Blueprint $table) {
            $table->id();
            // buyer
            $table->string('user_id')->nullable();
            $table->string('business_id')->nullable();
            // supplier
            $table->string('supplier_user_id')->nullable();
            $table->string('supplier_business_id')->nullable();
            $table->string('rfq_no')->nullable();
            $table->string('rfq_item_no')->nullable();
            $table->string('qoute_no')->nullable();
            $table->string('shipment_cost')->nullable();
            $table->string('total_cost')->nullable();
            $table->string('payment_term')->nullable();
            $table->string('item_code')->nullable();
            $table->string('item_name')->nullable();
            $table->string('uom')->nullable();
            $table->string('packing')->nullable();
            $table->string('brand')->nullable();
            $table->string('quantity')->nullable();
            $table->string('unit_price')->nullable();
            $table->string('warranty')->nullable();
            $table->string('contract')->nullable();
            $table->string('delivery_city')->nullable();
            $table->string('address')->nullable();
            $table->string('warehouse')->nullable();
            $table->string('delivery_status')->nullable();
            $table->string('delivery_time')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('vat')->nullable();
            $table->string('shipment')->nullable();
            $table->string('po_status')->nullable();
            $table->date('po_date')->nullable();
            $table->string('remarks')->nullable();
            $table->string('approval_details')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('draft_purchase_orders');
    }
}
