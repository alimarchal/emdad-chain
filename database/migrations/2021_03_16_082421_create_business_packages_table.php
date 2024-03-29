<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_packages', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id')->default(0);
            $table->integer('manual_payment_id')->nullable();
            $table->integer('business_type');
            $table->integer('business_id')->nullable();
            $table->integer('package_id');
            $table->integer('user_id');
            $table->string('categories')->nullable();
            $table->dateTime('subscription_start_date');
            $table->dateTime('subscription_end_date');
            $table->string('last_promocode')->nullable();
            $table->integer('promocode_given_count')->default(0);
            $table->integer('promocode_used_count')->default(0);
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('business_packages');
    }
}
