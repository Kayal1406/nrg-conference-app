<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conference', function (Blueprint $table) {
            $table->increments('id');
            $table->string('conferencename');
            $table->string('conferenceurl');
            $table->text('description');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('standarduser');
            $table->string('industry');
            $table->enum('frequency', ['LOY', 'OAY', 'MTY']);
            $table->longText('link');
            $table->boolean('is_active')->default('0');
            $table->string('salesforce_id');
            $table->enum('status_sm', ['Approved', 'Rejected', 'Deleted', 'Pending'])->default('Pending');
            $table->string('sm_remarks');
            $table->string('created_by');
            $table->timestamp('created_date');
            $table->string('modified_by');
            $table->dateTime('modified_date');
            $table->boolean('is_delete')->default('0');
            $table->string('phone');
            $table->string('conference_cost');
            $table->string('location');
            $table->date('conf_start');
            $table->date('travel_start');
            $table->date('conf_end');
            $table->date('travel_end');
            $table->string('travel_cost');
            $table->string('travel_city');
            $table->string('nrg_past');
            $table->string('attendees_travelling');
            $table->string('role');
            $table->string('sponsoring_cost');
            $table->string('benefits');
            $table->string('deliverables');
            $table->string('audience');
            $table->string('business');
            $table->string('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('conference');
    }
}
