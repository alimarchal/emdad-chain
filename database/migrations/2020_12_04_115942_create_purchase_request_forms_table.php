<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseRequestFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_request_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->nullable()->index();
            $table->foreignId('user_id')->nullable()->index();
            #for tracking one form
            $table->string('prf_multiple_id')->nullable();
            $table->string('item_code')->nullable();
            $table->string('item_name')->nullable();
            $table->string('description')->nullable();
            $table->string('unit_of_measurement')->nullable();
            $table->string('size')->nullable();
            $table->string('quantity')->nullable();
            $table->string('brand')->nullable();
            $table->string('last_price')->nullable();
            $table->string('remarks')->nullable();
            $table->string('delivery_period')->nullable();
            $table->string('file_path')->nullable();
            #supervisor
            $table->string('approver_one')->nullable();
            #final authority
            $table->string('approver_two')->nullable();
            $table->string('payment_mode')->nullable();
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
        Schema::dropIfExists('purchase_request_forms');
    }
}
