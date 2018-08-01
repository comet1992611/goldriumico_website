<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gsettings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('webTitle')->default('THESOFTKING');
            $table->string('colorCode')->default('336699');
            $table->string('curCode')->default('Dollor');
            $table->string('curSymbol')->default('$');
            $table->string('registration')->default('1');
            $table->string('emailVerify')->default('1');
            $table->string('smsVerify')->default('1');
            $table->integer('decimalPoint')->default('2');
            $table->string('emailNotify')->default('1');
            $table->string('smsNotify')->default('1');
            $table->text('emailMessage')->nullable();
            $table->string('emailSender')->default('email@example.com');
            $table->text('smsApi')->nullable();
            $table->string('startdate')->nullable();
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
        Schema::dropIfExists('gsettings');
    }
}
