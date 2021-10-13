<?php
namespace Jawabkom\Backend\Module\Profile\Test\Classes\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_requests', function (Blueprint $table) {
            $table->id();
            $table->string('hash')->index();
            $table->json('request_search_filters');
            $table->json('request_search_results')->nullable();
            $table->dateTime('request_date_time')->index();
            $table->string('result_alias_source')->index();
            $table->boolean('is_from_cache')->index();
            $table->json('other_params');
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
        Schema::dropIfExists('search_requests');
    }
}
