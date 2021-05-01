<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostSundaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_sundays', function (Blueprint $table) {
            $table->increments('id');
            $table->double('offering')->nullable();
            $table->double('tithe')->nullable();
            $table->double('donation')->nullable();
            $table->double('envelop')->nullable();
            $table->double('fundraising')->nullable();
            $table->string('typeofevent')->nullable();
            $table->integer('local_id')->index()->unsigned()->nullable();
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
        Schema::dropIfExists('post_sundays');
    }
}
