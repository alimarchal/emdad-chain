<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracking_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_id')->nullable()->index();
            $table->timestamp('timestamp')->nullable();
            $table->string('coordinates', 80)->nullable();
            $table->string('vehicle_id', 10)->nullable();
            $table->string('driver_id', 10)->nullable();
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
        Schema::dropIfExists('tracking_deliveries');
    }
}
