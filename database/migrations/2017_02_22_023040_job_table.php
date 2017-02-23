<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id');
            $table->integer('user_id');
            $table->string('company_name', 255);
            $table->string('company_address', 255);
            $table->string('company_job', 255);
            $table->string('company_picture', 255);
            $table->string('company_details', 255);
            $table->string('company_rate', 255);
            $table->string('company_status', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('job');
    }
}
