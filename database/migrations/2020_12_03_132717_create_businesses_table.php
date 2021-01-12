<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('business_name')->nullable();
            $table->string('num_of_warehouse')->nullable();
            $table->string('category_number')->nullable();
            $table->string('business_type')->nullable();
            $table->string('chamber_reg_number')->nullable();
            $table->string('chamber_reg_path')->nullable();
            $table->string('vat_reg_certificate_number')->nullable();
            $table->string('vat_reg_certificate_path')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('website')->nullable();
            $table->string('business_email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('iban')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            # supplier or client category of client
            $table->string('supplier_client')->nullable();
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
        Schema::dropIfExists('businesses');
    }
}
