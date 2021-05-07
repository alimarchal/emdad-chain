<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionPercentagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_percentages', function (Blueprint $table) {
            $table->id();
            $table->integer('commission_type');             /* 0 for sales, 1 for supplier & 2 for buyer */
            $table->integer('package_type')->nullable();             /* 0 for sales, 1 for supplier & 2 for buyer */
            $table->integer('ire_type');                    /* 0 for Employee, 1 for Non-Employee & 2 for Indirect Referral */
            $table->integer('amount_type');                 /* 0 for amount & 1 for percentage  */
            $table->decimal('amount', 13,2);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commission_percentages');
    }
}
