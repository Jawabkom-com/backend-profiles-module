<?php
namespace Jawabkom\Backend\Module\Profile\Test\Classes\Database\Migrations;

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
            $table->dateTime('valid_since')->nullable()->index();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('school')->nullable()->index();
            $table->string('degree')->nullable()->index();
            $table->string('major')->nullable();
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
