<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('local_code')->unique();
            $table->string('gps')->nullable();
            $table->date('date')->nullable();
            $table->string('photo1_id')->index()->nullable();
            $table->string('photo2_id')->index()->nullable();
            $table->string('photo3_id')->index()->nullable();
            $table->string('nurseringOrNot')->nullable();
            $table->string('localmode')->nullable();
            $table->integer('district_id')->index()->unsigned()->nullable();
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
        Schema::dropIfExists('locals');
    }
}
