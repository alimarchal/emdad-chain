<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qoutes', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('e_order_item_id')->nullable();
            $table->string('warehouse_id')->nullable();
            $table->string('quote_quantity')->nullable();
            $table->string('quote_price_per_quantity')->nullable();
            $table->string('sample_information')->nullable();
            $table->string('sample_unit')->nullable();
            $table->string('sample_security_charges')->nullable();
            $table->string('sample_charges_per_unit')->nullable();
            $table->string('shipping_time_in_days')->nullable();
            $table->string('shipment_cost')->nullable();
            $table->string('VAT')->nullable();
            $table->string('total_cost')->nullable();
            $table->text('note_for_customer')->nullable();
            $table->string('qoute_status')->nullable();
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
        Schema::dropIfExists('qoutes');
    }
}
