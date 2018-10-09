<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('mngfirstname');
            $table->string('mnglastname');
            $table->string('mngemail');
            $table->string('confname');
            $table->date('confstart');
            $table->date('confend');
            $table->string('confurl');
            $table->enum('travel', ['Yes', 'No']);
            $table->date('travelstart');
            $table->date('travelend');
            $table->string('costs');
            $table->enum('marketing', ['Yes', 'No']);
            $table->string('travelcosts');
            $table->enum('role', ['Attend for Training/Education', 'Attend for Leads Generation', 'Exhibit/Sponsor', 'Speak']);
            $table->enum('sponsoring', ['Yes', 'No']);
            $table->string('business');
            $table->string('benefits');
            $table->text('manager_remarks');
            $table->enum('status_m', ['Approved', 'Rejected','Pending']);
            $table->enum('status_sm', ['Approved', 'Rejected', 'Deleted','Pending']);
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
        Schema::drop('requests');
    }
}
