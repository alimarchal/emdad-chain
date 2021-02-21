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
            $table->foreignId('draft_purchase_order_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('user_id')->nullable();
            $table->string('captain_id')->nullable();
            $table->string('business_id')->nullable();
            $table->string('supplier_user_id')->nullable();
            $table->string('supplier_business_id')->nullable();
            $table->string('item_code')->nullable();
            $table->string('item_name')->nullable();
            $table->string('uom')->nullable();
            $table->string('packing')->nullable();
            $table->string('brand')->nullable();
            $table->string('quantity')->nullable();
            $table->string('unit_price')->nullable();
            $table->string('rfq_no')->nullable();
            $table->string('rfq_item_no')->nullable();
            $table->string('qoute_no')->nullable();
            $table->string('payment_term')->nullable();
            $table->string('delivery_address')->nullable();
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
