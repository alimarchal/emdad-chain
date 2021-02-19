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
            $table->unsignedInteger('vehicle_type')->index();
            $table->unsignedInteger('business_id')->index();
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
