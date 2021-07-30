<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogisticsBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logistics_businesses', function (Blueprint $table) {

            $table->id();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('business_name')->nullable();
            $table->string('chamber_reg_number')->nullable();
            $table->string('chamber_reg_path')->nullable();
            $table->string('vat_reg_certificate_number')->nullable();
            $table->string('vat_reg_certificate_path')->nullable();
            $table->string('business_photo_url')->nullable();
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
            $table->integer('legal_status')->default(1);
            $table->string('status')->nullable(); /* 1 for pending, 3 for approved, 4 for rejected*/
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
        Schema::dropIfExists('logistics_businesses');
    }
}
