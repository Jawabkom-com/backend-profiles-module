<?php

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
            $table->string('type')->index();
            $table->boolean('do_not_call_flag')->index();
            $table->string('country_code')->index();
            $table->string('original_number')->index();
            $table->string('formatted_number')->index();
            $table->boolean('valid_phone');
            $table->boolean('risky_phone');
            $table->boolean('disposable_phone');
            $table->string('carrier')->index();
            $table->string('purpose')->index();
            $table->string('industry')->index();
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
