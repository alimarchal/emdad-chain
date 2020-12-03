<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessFinanceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_finance_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->nullable()->index();
            # main finance detail of company relate to business
            $table->string('designation')->nullable();
            $table->string('name')->nullable();
            $table->string('landline')->nullable();
            $table->string('mobile')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('iban')->nullable();
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
        Schema::dropIfExists('business_finance_details');
    }
}
