<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_type');
            $table->integer('user_type');
            $table->string('charges');
            $table->string('registeration');
            $table->integer('category');
            $table->integer('sub_category');
            $table->string('quotations')->nullable();
            $table->string('emdad_tools');
            $table->integer('super_admin_count')->nullable();
            $table->integer('users')->nullable();
            $table->string('truck');
            $table->string('driver');
            $table->string('rfq_per_day')->nullable();
            $table->string('quotations_per_rfq')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('training');
            $table->string('discount_code')->nullable();
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
        Schema::dropIfExists('packages');
    }
}
