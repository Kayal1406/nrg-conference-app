<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewconferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newconference', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('conferencename');
            $table->string('conferenceurl');
            $table->text('description');
            $table->text('industry');
            $table->text('business');
            $table->text('notes');
            $table->enum('frequency', ['LOY', 'OAY', 'MTY']);
            $table->text('manager_remarks');
            $table->enum('status_m', ['Pending', 'Approved', 'Rejected']);
            $table->enum('status_sm', ['Pending', 'Approved', 'Rejected', 'Deleted']);
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
        Schema::drop('newconference');
    }
}
