<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIreCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ire_commissions', function (Blueprint $table) {
            $table->id();
            $table->string('ire_no')->nullable();
            $table->string('user_id');
            $table->bigInteger('type');
            $table->integer('status')->default(0);
            $table->string('payment_status')->default(0);
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
        Schema::dropIfExists('ire_commissions');
    }
}
