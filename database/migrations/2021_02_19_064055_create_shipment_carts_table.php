<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('driver_id')->index();
            $table->unsignedInteger('vehicle_id')->index();
            $table->unsignedInteger('supplier_business_id')->index();
            $table->unsignedInteger('buyer_business_id')->index();
            $table->integer('rfq_type');                                     /* 0 for single category RFQ, 1 for multi categories */
            $table->integer('rfq_no');                                     /* 0 for single category RFQ, 1 for multi categories */
            $table->unsignedInteger('delivery_id')->index();
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
        Schema::dropIfExists('shipment_carts');
    }
}
