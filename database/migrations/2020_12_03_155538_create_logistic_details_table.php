<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogisticDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logistic_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_warehouse_id')->nullable()->index();
            $table->string('no_of_drivers')->nullable();
            $table->string('vehicle_types')->nullable();
            $table->string('temperature_facility')->nullable();
            $table->string('working_time')->nullable();
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
        Schema::dropIfExists('logistic_details');
    }
}
