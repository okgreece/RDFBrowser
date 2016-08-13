<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeoExtractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geo_extractors', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('type');
            $table->string('generic');
            $table->string('genericFormat');
            $table->string('lat');
            $table->string('latFormat');
            $table->string('long');
            $table->string('longFormat');
            $table->boolean('enabled');
            $table->integer('order')->unique();
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
        Schema::drop('geo_extractors');
    }
}
