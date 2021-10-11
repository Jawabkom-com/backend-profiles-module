<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_relationships', function (Blueprint $table) {
            $table->id();
            $table->string('profile_id')->index();
            $table->dateTime('valid_since')->index();
            $table->string('type')->index();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('person_id')->index();
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
        Schema::dropIfExists('profile_relationships');
    }
}
