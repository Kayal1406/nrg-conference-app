<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConferencefeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->string('conferencename');
            $table->string('yourname');
            $table->string('email');
            $table->string('approvalmanager');
            $table->string('experience');
            $table->string('action');
            $table->string('recommendations');
            $table->string('leads');
            $table->string('attendee');
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
        Schema::drop('feedback');
    }
}
