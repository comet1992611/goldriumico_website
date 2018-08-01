<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->increments('id');
            $table->string('wdid');
            $table->integer('user_id')->unsigned();
            $table->string('amount');
            $table->string('charge');
            $table->integer('wdmethod_id')->unsigned();
            $table->text('details')->nullable();
            $table->integer('status');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('wdmethod_id')->references('id')->on('wdmethods');
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
        Schema::dropIfExists('withdraws');
    }
}
