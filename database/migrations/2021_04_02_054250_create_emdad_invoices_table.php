<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmdadInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emdad_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('invoice_id')->index();
            $table->unsignedInteger('supplier_business_id');
            $table->string('charges');            // emdad charges  (1.5% of total cost w/o VAT)
            $table->integer('send_status')->default(0);   //  default 0 for not send to supplier & 1 for sen to supplier
            $table->integer('status')->default(0);   //  default 0 for not paid & 1 for paid
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
        Schema::dropIfExists('emdad_invoices');
    }
}
