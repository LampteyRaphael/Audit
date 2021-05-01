<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictExpendituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('district_expenditures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('district_income_categories_id')->index()->unsigned();
            $table->integer('district_id')->index()->unsigned();
            $table->string('amount');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->foreign('district_income_categories_id')->references('id')->on('district_expenditure_categories')->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('district_expenditures');
    }
}
