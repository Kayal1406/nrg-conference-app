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
            $table->string('description');
            $table->string('user_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->date('deadline_reg');
            $table->string('conference_location');
            $table->string('conference_venue');
            $table->date('travel_date');
            $table->string('role');
            $table->string('nrg_past');
            $table->string('goal');
            $table->string('industry');
            $table->string('audience');
            $table->string('benefits');
            $table->string('deliverable');
            $table->string('materials');
            $table->float('cost');
            $table->text('manager_remarks');
            $table->enum('status_m', ['Approved', 'Rejected']);
            $table->enum('status_sm', ['Approved', 'Rejected', 'Deleted']);
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
        Schema::drop('conference');
    }
}
