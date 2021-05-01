<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalSMSSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_s_m_s_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('smsGeneratedCode')->nullable();
            $table->string('smsVerificationCode')->nullable();
            $table->double('amount')->nullable();
            $table->integer('smsToPost')->nullable();
            $table->integer('smsPosted')->nullable();
            $table->integer('local_id');
            $table->integer('is_active')->default(0);
            $table->integer('block')->default(0);
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
        Schema::dropIfExists('local_s_m_s_s');
    }
}
