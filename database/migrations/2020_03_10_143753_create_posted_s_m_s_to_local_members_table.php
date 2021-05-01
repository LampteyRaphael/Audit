<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostedSMSToLocalMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posted_s_m_s_to_local_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('local_id');
            $table->integer('users_id');
            $table->integer('smsCount')->nullable();
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
        Schema::dropIfExists('posted_s_m_s_to_local_members');
    }
}
