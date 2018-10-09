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
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('mngfirstname');
            $table->string('mnglastname');
            $table->string('mngemail');
            $table->string('confname');
            $table->date('confstart');
            $table->date('confend');
            $table->text('confurl');
            $table->enum('travel', ['Yes', 'No']);
            $table->date('travelstart');
            $table->date('travelend');
            $table->string('costs');
            $table->enum('support', ['Yes', 'No']);
            $table->string('travelcosts');
            $table->enum('role', ['Training/Education', 'Leads', 'Sponsor', 'Speak']);
            $table->enum('sponsoring', ['Yes', 'No']);
            $table->string('business');
            $table->string('benefits');
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
        Schema::drop('apply');
    }
}
