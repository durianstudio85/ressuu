<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WorkExperienceTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_experience', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('company_name', 255);
            $table->string('job_title', 255);
            $table->string('start_date', 255);
            $table->string('end_date', 255);
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('work_experience');
    }
}
