<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logistics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_id')->nullable()->index();
            $table->string('ire_no')->nullable();
            $table->string('gender')->nullable();
            $table->string('name')->nullable();
            $table->string('middle_initial')->nullable();
            $table->string('family_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->text('profile_photo_path')->nullable();
            $table->string('mobile')->nullable();
            $table->string('user_type')->nullable();
            $table->string('nid_num')->nullable();
            $table->date('nid_exp_date')->nullable();
            $table->boolean('is_active')->default(0);
            $table->bigInteger('rtl')->default(0);
            $table->bigInteger('status')->default(0);
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
        Schema::dropIfExists('logistics');
    }
}
