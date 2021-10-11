<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_education', function (Blueprint $table) {
            $table->id();
            $table->string('profile_id')->index();
            $table->dateTime('valid_since')->index();
            $table->string('from');
            $table->string('to');
            $table->string('school')->index();
            $table->string('degree')->index();
            $table->string('major');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_education');
    }
}
