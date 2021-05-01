<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_incomes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('area_income_categories_id')->index()->unsigned();
            $table->integer('area_id')->index()->unsigned();
            $table->string('amount');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->foreign('area_income_categories_id')->references('id')->on('area_income_categories')->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_incomes');
    }
}
