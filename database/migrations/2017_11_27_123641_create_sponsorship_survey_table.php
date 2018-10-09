<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsorshipSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsorship_survey', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conference_id')->unsigned();
            $table->foreign('conference_id')->references('id')->on('conference');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('standarduser');
            $table->string('sponsorship_costs');
            $table->string('is_speaker');
            $table->enum('leads', ['20', '40', '60']);
            $table->enum('booth_traffic', ['20', '40', '60']);
            $table->enum('relevant', ['20', '40', '60']);
            $table->enum('promotional_assets', ['20', '40', '60']);
            $table->enum('nrg_social_mentions', ['20', '40', '60']);
            $table->enum('conf_social_mentions', ['20', '40', '60']);
            $table->enum('invite_open', ['20', '40', '60']);
            $table->boolean('is_delete')->default('0');
            $table->timestamp('created_date');
            $table->string('created_by');
            $table->string('updated_by');
            $table->dateTime('updated_date');
            $table->string('conference_score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sponsorship_survey');
    }
}
