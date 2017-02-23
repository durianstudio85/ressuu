<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectionRequestTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connection_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('to_user_id');
            $table->integer('from_user_id');
            $table->string('date', 255);
            $table->string('status', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('connection_requests');
    }
}
