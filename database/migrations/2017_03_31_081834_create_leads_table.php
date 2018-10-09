<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conferenceid')->unsigned();
            $table->foreign('conferenceid')->references('id')->on('conference');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('standarduser');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('title');
            $table->string('company');
            $table->string('email');
            $table->string('phonenumber');
            $table->string('description');
            $table->string('created_by');
            $table->dateTime('created_date');
            $table->string('modified_by');
            $table->dateTime('modified_date');
            $table->boolean('is_delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('leads');
    }
}
