<?php
namespace Jawabkom\Backend\Module\Profile\Test\Classes\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_names', function (Blueprint $table) {
            $table->id();
            $table->string('profile_id')->index();
            $table->string('prefix')->nullable();
            $table->string('first')->nullable()->index();
            $table->string('middle')->nullable()->index();
            $table->string('last')->nullable()->index();
            $table->string('display')->nullable();
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
        Schema::dropIfExists('profile_names');
    }
}
