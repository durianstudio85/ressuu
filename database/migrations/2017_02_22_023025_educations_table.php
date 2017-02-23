<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EducationsTable extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('school', 255);
            $table->string('course', 255);
            $table->string('date_start', 255);
            $table->string('date_end', 255);
            $table->text('awards_rec');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('education');
    }
}
