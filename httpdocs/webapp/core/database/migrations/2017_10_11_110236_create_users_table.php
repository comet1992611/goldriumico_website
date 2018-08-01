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
            $table->increments('id');
            $table->integer('refid')->nullable();
            $table->integer('package_id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('balance')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('date');
            $table->string('address');
            $table->string('city');
            $table->string('postcode');
            $table->string('country');
            $table->string('mobile');
            $table->string('bitcoin');
            $table->integer('docv');
            $table->integer('gtfa');
            $table->integer('tfav');
            $table->string('email')->unique();
            $table->integer('status')->nullable();
            $table->integer('paystatus')->nullable();
            $table->string('trxpin')->nullable();
            $table->string('emailv')->nullable();
            $table->string('smsv')->nullable();
            $table->string('vsent')->nullable();
            $table->string('vercode')->nullable();
            $table->string('forgotcode')->nullable();
            $table->string('secretcode')->nullable();
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
