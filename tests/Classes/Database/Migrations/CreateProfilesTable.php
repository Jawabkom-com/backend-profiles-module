<?php
namespace Jawabkom\Backend\Module\Profile\Test\Classes\Database\Migrations;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('profile_id')->unique();
            $table->string('gender')->nullable()->index();
            $table->string('date_of_birth')->nullable()->index();
            $table->string('place_of_birth')->nullable()->index();
            $table->string('data_source')->index();
            $table->string('hash')->index();
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
        Schema::dropIfExists('profiles');
    }
}
