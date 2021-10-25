<?php
namespace Jawabkom\Backend\Module\Profile\Test\Classes\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileCriminalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_criminal_records', function (Blueprint $table) {
            $table->id();
            $table->string('profile_id')->index();
            $table->string('case_number')->nullable()->index();
            $table->string('case_type')->nullable()->index();
            $table->string('case_year')->nullable()->index();
            $table->string('case_status')->nullable()->index();
            $table->string('display')->nullable();
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
        Schema::dropIfExists('profile_criminal_records');
    }
}
