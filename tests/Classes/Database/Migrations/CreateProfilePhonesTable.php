<?php
namespace Jawabkom\Backend\Module\Profile\Test\Classes\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_phones', function (Blueprint $table) {
            $table->id();
            $table->string('profile_id')->index();
            $table->string('type')->nullable()->index();
            $table->boolean('do_not_call_flag')->nullable()->index();
            $table->string('valid_since')->nullable()->index();
            $table->string('country_code')->nullable()->index();
            $table->string('original_number')->nullable()->index();
            $table->string('formatted_number')->nullable()->index();
            $table->boolean('valid_phone')->nullable();
            $table->boolean('risky_phone')->nullable();
            $table->boolean('disposable_phone')->nullable();
            $table->string('carrier')->nullable()->index();
            $table->string('purpose')->nullable()->index();
            $table->string('industry')->nullable()->index();
            $table->json('possible_countries')->default('[]');
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
        Schema::dropIfExists('profile_phones');
    }
}
