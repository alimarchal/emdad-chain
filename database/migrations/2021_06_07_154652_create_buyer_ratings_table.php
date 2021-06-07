<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyerRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer_ratings', function (Blueprint $table) {
            $table->id();
            # Driver ==> Buyer
            $table->integer('buyer_user_id')->nullable();
            $table->integer('buyer_business_id')->nullable();
            # rating_business_id is for driver, or supplier business_id or emdad-business
            $table->integer('rating_business_id')->nullable();
            # rating type Driver , Supplier, Emdad-Chain
            $table->string('buyer_rating_type')->nullable();
            $table->enum('buyer_recommend',['Yes','No'])->nullable();
            # rating out of 5
            $table->integer('rating')->nullable();
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
        Schema::dropIfExists('buyer_ratings');
    }
}
