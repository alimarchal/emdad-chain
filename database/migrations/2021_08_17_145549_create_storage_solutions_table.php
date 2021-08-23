<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorageSolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_solutions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('logistics_businesse_id');
            $table->integer('box_quantity_pieces')->nullable();
            $table->unsignedDouble('weight_piece')->default(0);
            $table->boolean('temprature_ctrl')->default(0);
            $table->integer('temprature_ctrl_max')->default(0);
            $table->integer('temprature_ctrl_min')->default(0);
            $table->decimal('length',11,2)->nullable();
            $table->decimal('width',11,2)->nullable();
            $table->decimal('height',11,2)->nullable();
            $table->decimal('per_day',14,2)->default(0.00);
            $table->decimal('per_week',14,2)->default(0.00);
            $table->decimal('month',14,2)->default(0.00);
            $table->decimal('quarter',14,2)->default(0.00);
            $table->decimal('half_year',14,2)->default(0.00);
            $table->decimal('one_year',14,2)->default(0.00);
            $table->string('commodity_type',191)->nullable();
            $table->string('commodity_information',191)->nullable();
            $table->string('msds',191)->nullable();
            $table->string('msds_information',191)->nullable();
            $table->string('latitude',25)->nullable();
            $table->string('longitude',25)->nullable();
            $table->text('address')->nullable();
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
        Schema::dropIfExists('storage_solutions');
    }
}
