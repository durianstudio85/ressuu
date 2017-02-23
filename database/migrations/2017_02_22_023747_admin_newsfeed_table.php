<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminNewsfeedTable extends Migration
{
       /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_news_feeds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('activity', 255);
            $table->string('date', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admin_news_feeds');
    }
}
