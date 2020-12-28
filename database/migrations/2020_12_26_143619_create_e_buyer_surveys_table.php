<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEBuyerSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_buyer_surveys', function (Blueprint $table) {
            $table->id();
            $table->string('question',191)->nullable();
            $table->string('question_ar',191)->nullable();
            $table->string('question_ur',191)->nullable();
            $table->string('category',50)->nullable();
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
        Schema::dropIfExists('e_buyer_surveys');
    }
}
