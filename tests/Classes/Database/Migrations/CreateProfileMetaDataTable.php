<?php
namespace Jawabkom\Backend\Module\Profile\Test\Classes\Database\Migrations;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileMetaDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_meta_data', function (Blueprint $table) {
            $table->id();
            $table->string('profile_id')->index();
            $table->string('meta_key')->nullable()->index();
            $table->string('meta_value')->nullable()->index();
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
        Schema::dropIfExists('profile_meta_data');
    }
}
