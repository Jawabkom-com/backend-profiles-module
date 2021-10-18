<?php
namespace Jawabkom\Backend\Module\Profile\Test\Classes\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearcherStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('searcher_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('searcher_alias')->index();
            $table->integer('status_hour')->index();
            $table->integer('status_day');
            $table->integer('status_month');
            $table->integer('status_year');
            $table->integer('counter');
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
        Schema::dropIfExists('searcher_statuses');
    }
}
