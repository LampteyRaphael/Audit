<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationAndPledgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_and_pledges', function (Blueprint $table) {
            $table->increments('id');
            $table->double('amount');
            $table->tinyInteger('modeOfPayment')->nullable();
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->string('donationOrPledge')->nullable();
            $table->string('dateOfCheque')->nullable();
            $table->string('checkNo')->nullable();
            $table->string('bank')->nullable();
            $table->integer('local_id')->index()->nullable();
//            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
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
        Schema::dropIfExists('donation_and_pledges');
    }
}
