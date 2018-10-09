<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reason');
            $table->string('competitors');
            $table->string('conference_costs');
            $table->string('conference_expenses');
            $table->string('scheduled');
            $table->string('attended');
            $table->string('personal_contacts');
            $table->string('elaborateno');
            $table->string('additional_plans');
            $table->string('recommend');
            $table->string('attendees');
            $table->string('companies');
            $table->timestamp('created_at');
            $table->dateTime('updated_at');
            $table->boolean('is_delete');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('standarduser');
            $table->integer('conferenceid')->unsigned();
            $table->foreign('conferenceid')->references('id')->on('conference');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('survey');
    }
}
