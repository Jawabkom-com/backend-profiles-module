<?php
namespace Jawabkom\Backend\Module\Profile\Test\Classes\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfflineSearchRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offline_search_requests', function (Blueprint $table) {
            $table->id();
            $table->string('status')->index();
            $table->integer('matches_count')->index();
            $table->string('hash')->index();
            $table->json('error_messages')->nullable();
            $table->json('request_search_filters')->nullable();
            $table->dateTime('request_date_time')->index();
            $table->json('other_params')->nullable();
            $table->json('request_meta')->nullable();
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
        Schema::dropIfExists('offline_search_requests');
    }
}
