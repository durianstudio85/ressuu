<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProfileTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('email', 255);
            $table->string('name', 255);
            $table->string('position', 255);
            $table->string('bday', 255);
            $table->string('address', 255);
            $table->string('url', 255);
            $table->string('bio', 255);
            $table->string('profile_picture', 255);
            $table->string('facebook', 255);
            $table->string('linkedin', 255);
            $table->string('twitter', 255);
            $table->string('google', 255);
            $table->integer('is_logged_in');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profiles');
    }
}
