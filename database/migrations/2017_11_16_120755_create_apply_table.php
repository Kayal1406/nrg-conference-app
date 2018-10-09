<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('mngemail');
            $table->integer('conferenceid');
            $table->string('confname');
            $table->date('confstart');
            $table->date('confend');
            $table->text('confurl');
            $table->date('travelstart');
            $table->date('travelend');
            $table->string('role');
            $table->string('business')->default('No');
            $table->string('benefits')->default('No');
            $table->longText('link');
            $table->string('admin_remarks');
            $table->text('manager_remarks');
            $table->enum('status_m', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->enum('status_sm', ['Pending', 'Approved', 'Rejected', 'Deleted'])->default('Pending');
            $table->string('created_by');
            $table->timestamp('created_date');
            $table->string('modified_by');
            $table->dateTime('modified_date');
            $table->boolean('is_delete')->default('0');
            $table->string('phone');
            $table->string('another_phone');
            $table->string('another_email');
            $table->string('conf_frequency');
            $table->string('conf_cost');
            $table->string('travel_cost');
            $table->string('conf_location');
            $table->string('conf_city');
            $table->string('attendees_travelling');
            $table->string('description');
            $table->string('deliverables');
            $table->string('industry');
            $table->string('audience');
            $table->string('sponsoring_cost');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('apply');
    }
}
