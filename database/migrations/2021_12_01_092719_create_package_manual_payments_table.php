<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageManualPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_manual_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('business_id')->nullable();
            $table->integer('business_type');                         /* 1 Buyer, 2 Supplier */
            $table->tinyInteger('package_id');
            $table->string('bank_name');
            $table->string('amount_received');
            $table->string('account_number');
            $table->dateTime('amount_date');
            $table->string('receipt');
            $table->tinyInteger('upgrade')->default(0);         /* 0 not upgraded by user, 1 he upgraded from a package */
            $table->tinyInteger('status')->default(0);          /* 0 Emdad verification pending, 1 Emdad confirmed, 2 Emdad rejected */
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
        Schema::dropIfExists('package_manual_payments');
    }
}
