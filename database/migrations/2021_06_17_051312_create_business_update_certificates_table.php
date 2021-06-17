<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessUpdateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_update_certificates', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id');
            $table->string('vat_reg_certificate_path')->nullable();
            $table->string('chamber_reg_path')->nullable();
            $table->string('business_photo_url')->nullable();
            $table->integer('legal_officer_status')->default(0);  /* 0 for pending, 1 for accepted, 2 for rejected*/
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
        Schema::dropIfExists('business_update_certificates');
    }
}
