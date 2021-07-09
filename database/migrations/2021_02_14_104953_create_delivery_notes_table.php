<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('draft_purchase_order_id')->nullable()->index();
            $table->integer('rfq_no');
            $table->string('user_id')->nullable();
            $table->string('business_id')->nullable();
            // suppliers
            $table->string('supplier_user_id')->nullable();
            $table->string('supplier_business_id')->nullable();
            $table->string('delivery_address')->nullable();
            $table->string('city')->nullable();
            $table->string('warranty')->nullable();
            $table->string('terms_and_conditions')->nullable();
            $table->string('update_user_id')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('delivery_notes');
    }
}
