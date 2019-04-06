<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id')->unsigned();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('patronymic')->nullable();
            $table->bigInteger('gender_id')->unsigned();
            $table->date('birthday')->nullable();
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->string('login');
            $table->string('password');
            $table->bigInteger('country_id')->unsigned();
            $table->bigInteger('city_id')->unsigned();
            $table->string('image_profile')->nullable();
            $table->float('rating')->nullable();
            $table->boolean('is_confirmed_email')->default(false);
            $table->string('confirmed_email_token')->nullable();
            $table->boolean('is_confirmed_phone')->default(false);
            $table->string('confirmed_phone_code')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
