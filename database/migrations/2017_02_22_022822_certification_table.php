<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CertificationTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certification', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('certificate_title', 255);
            $table->string('certificate_company', 255);
            $table->string('certificate_receive', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('certification');
    }
}
