<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_id')->nullable();
            $table->string('designation')->nullable();
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('nid_photo')->nullable();
            $table->string('company_name')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->string('registration_type')->nullable();
            $table->string('profile_approved')->nullable();
            $table->string('profile_approval_id')->nullable();
            $table->string('mobile')->nullable();
            $table->string('mobile_verify_code')->nullable();
            $table->tinyInteger('mobile_verify')->default(0);
            $table->string('mobile_verify_token')->nullable();
            $table->string('status')->nullable();
            $table->boolean('is_active')->default(0);
            $table->string('usertype')->nullable();
            $table->string('driver_status')->default(1);
            $table->integer('added_by')->default(0);            /* 1 for Buyer and 2 for Supplier */
            $table->bigInteger('added_by_userId')->nullable();
            $table->boolean('logistic_solution')->nullable();
            $table->boolean('packaging_solution')->nullable();
            $table->boolean('storage_solution')->nullable();
            $table->boolean('transportation_solution')->nullable();
            $table->boolean('international_cargo')->nullable();
            $table->bigInteger('rtl')->default(0);
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
        Schema::dropIfExists('users');
    }
}
