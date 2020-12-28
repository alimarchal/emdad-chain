<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEBuyerSurveyAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_buyer_survey_answers', function (Blueprint $table) {
            $table->id();
            $table->string('question1',100)->nullable();
            $table->string('question2',100)->nullable();
            $table->string('question3',100)->nullable();
            $table->string('question4',100)->nullable();
            $table->string('question5',100)->nullable();
            $table->string('question6',100)->nullable();
            $table->string('question7',100)->nullable();
            $table->string('question8',100)->nullable();
            $table->string('question9',100)->nullable();
            $table->string('question10',100)->nullable();
            $table->string('question11',100)->nullable();
            $table->string('question12',100)->nullable();
            $table->string('question13',100)->nullable();
            $table->string('question14',100)->nullable();
            $table->string('question15',100)->nullable();
            $table->string('question16',100)->nullable();
            $table->string('question17',100)->nullable();
            $table->string('question18',100)->nullable();
            $table->string('question19',100)->nullable();
            $table->string('question20',100)->nullable();
            $table->string('question21',100)->nullable();
            $table->string('question22',100)->nullable();
            $table->string('question23',100)->nullable();
            $table->string('question24',100)->nullable();
            $table->string('question25',100)->nullable();
            $table->string('question26',100)->nullable();
            $table->string('question27',100)->nullable();
            $table->string('question28',100)->nullable();
            $table->string('question29',100)->nullable();
            $table->string('question30',100)->nullable();
            $table->string('question31',100)->nullable();
            $table->string('question32',100)->nullable();
            $table->string('question33',100)->nullable();
            $table->string('question34',100)->nullable();
            $table->string('question35',100)->nullable();
            $table->string('question36',100)->nullable();
            $table->string('question37',100)->nullable();
            $table->string('question38',100)->nullable();
            $table->string('language',100)->nullable();
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
        Schema::dropIfExists('e_buyer_survey_answers');
    }
}
