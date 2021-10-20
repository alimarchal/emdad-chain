<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierBankPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_bank_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('bank_payment_id');
            $table->string('bank_name');
            $table->integer('rfq_no')->default(0);                              /* 0 means multi categories */
            $table->string('amount_received');
            $table->string('account_number');
            $table->string('amount_date');
            $table->string('file_path');
            $table->string('supplier_business_id');
            $table->string('supplier_user_id');
            $table->integer('status');
            $table->integer('rfq_type');                             /* 0 for single category RFQ, 1 for multi categories */
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
        Schema::dropIfExists('supplier_bank_payments');
    }
}
