<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('application_reference')->unique();
            $table->string('fathers_name');
            $table->string('national_code')->unique()->nullable();
            $table->string('id_number');
            $table->string('birth_date');
            $table->string('birth_place');
            $table->string('place_of_issue');
            $table->boolean('marital_status')->nullable();
            $table->string('children')->nullable();
            $table->string('landline')->nullable();
            $table->string('state');
            $table->string('city');
            $table->string('address');
            $table->boolean('employment_status')->nullable();
            $table->string('place_of_work')->nullable();
            $table->string('level_1_grade')->nullable();
            $table->string('level_2_grade')->nullable();
            $table->string('level_3_grade')->nullable();
            $table->string('level_4_grade')->nullable();
            $table->string('level_5_grade')->nullable();
            $table->string('current_school');
            $table->dateTime('printed_card_at');
            $table->boolean('accepted_exam')->nullable();
            $table->dateTime('interview_at');
            $table->boolean('accepted_interview')->nullable();
            $table->boolean('canceled')->nullable();
            $table->boolean('form_complete')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('applications');
    }
}
