<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_warehouses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->nullable()->index();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('designation')->nullable();
            $table->string('warehouse_name');
            $table->string('name')->nullable();
            $table->string('warehouse_email')->nullable();
            $table->string('landline')->nullable();
            $table->integer('mobile')->nullable();
            $table->tinyInteger('mobile_verified')->default(0);
            $table->integer('mobile_verification_code')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            # Supplier or Client
            $table->string('warehouse_type')->nullable();
            $table->string('cold_storage')->nullable();
            $table->string('gate_type')->nullable();
            $table->string('fork_lift')->nullable();
            $table->string('total_warehouse_manpower')->nullable();
            $table->string('number_of_delivery_vehicles')->nullable();
            $table->string('number_of_drivers')->nullable();
            $table->string('vehicle_category')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('working_time')->nullable();
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
        Schema::dropIfExists('business_warehouses');
    }
}
