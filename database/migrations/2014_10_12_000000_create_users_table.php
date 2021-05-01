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
            $table->integer('local_id')->index();
            $table->integer('district_id')->index();
            $table->integer('area_id')->index();
            $table->integer('region_id')->index();
            $table->string('name');
            $table->string('gender');
            $table->string('birthDate')->nullable();;
            $table->string('placeOfBirth')->nullable();
            $table->string('hometown');
            $table->string('hometown_region')->nullable();
            $table->string('nationality')->nullable();;
            $table->string('languagess')->nullable();;
            $table->string('maritalStatus')->nullable();;
            $table->string('mariagetype')->nullable();
            $table->string('spouseName')->nullable();
            $table->integer('numberOfChildren')->nullable();;
            $table->string('fathers_name')->nullable();
            $table->string('fathers_hometown')->nullable();
            $table->string('mothers_name')->nullable();
            $table->string('mothers_hometown')->nullable();
            $table->string('digitalAddress')->nullable();
            $table->string('houseaddress')->nullable();
            $table->string('streetname')->nullable();
            $table->string('landmark')->nullable();
            $table->string('mobileNumber1')->nullable();
            $table->string('mobileNumber2')->nullable();
            $table->string('workNumber')->nullable();
            $table->string('whatsappNumber')->nullable();
            $table->string('email')->unique();
            $table->string('education')->nullable();
            $table->string('courseStudied')->nullable();
            $table->string('employmentType')->nullable();
            $table->string('profOccupation')->nullable();
            $table->string('placeOfWork')->nullable();
            $table->string('datejoinchurch')->nullable();
            $table->string('previousdenomination')->nullable();
            $table->string('waterBaptism')->nullable();
            $table->string('baptismBy')->nullable();
            $table->string('baptismDate')->nullable();
            $table->string('baptismLocality')->nullable();
            $table->string('rightHandOfFellowship');
            $table->string('communicant')->nullable();
            $table->string('holySpiritBaptism')->nullable();
            $table->string('anySpiritualGift')->nullable();;
            $table->string('pleaseIndicate')->nullable();
            $table->string('officeHeld')->nullable();
            $table->string('ordainedBy')->nullable();
            $table->string('dateOrdained')->nullable();
            $table->string('movementGroup')->nullable();
            $table->string('position')->nullable();
            $table->integer('role_id')->index()->unsigned();
            $table->integer('is_active')->index()->default(0);
            $table->string('password');
            $table->string('members_id')->index()->nullable();
            $table->string('photo_id')->index()->nullable();
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
