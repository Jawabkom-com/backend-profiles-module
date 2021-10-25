<?php
namespace Jawabkom\Backend\Module\Profile\Test\Classes\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileSocialProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_social_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('profile_id')->index();
            $table->dateTime('valid_since')->nullable()->index();
            $table->string('url')->nullable();
            $table->string('type')->nullable()->index();
            $table->string('username')->nullable()->index();
            $table->string('account_id')->nullable()->index();
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
        Schema::dropIfExists('profile_social_profiles');
    }
}
