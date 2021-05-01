<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category');
            $table->string('ministers')->nullable();
            $table->string('elders')->nullable();
            $table->string('	deacon')->nullable();
            $table->string('deaconess')->nullable();
            $table->string('male')->nullable();
            $table->string('female')->nullable();
            $table->string('children')->nullable();
            $table->string('visitors')->nullable();
            $table->integer('local_id')->index();
            $table->integer('talley');
            $table->timestamps();
           // $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
