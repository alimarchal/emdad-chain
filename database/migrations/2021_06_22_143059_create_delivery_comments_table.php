<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('delivery_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('business_id')->nullable();
            $table->text('comment_content')->nullable();
            /*
                0 => 'Rating by Driver for Buyer'
                1 => 'Rating by Supplier for Buyer'
                2 => 'Rating by Supplier for Emdad'
                3 => 'Rating by Buyer for driver'
                4 => 'Rating by Buyer for Supplier'
                5 => 'Rating by Buyer for Emdad'
                6 => 'Rating by Emdad for Supplier'
                7 => 'Rating by Emdad for Buyer'
             */
            $table->integer('comment_type')->nullable();
            # rating 1 to 5
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
        Schema::dropIfExists('delivery_comments');
    }
}
