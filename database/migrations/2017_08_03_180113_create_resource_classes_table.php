<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResourceClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_classes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('classUrl');
            $table->boolean('enabled');
            $table->boolean('pagination');
            $table->integer('pagination_size');
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
        Schema::drop('resource_classes');
    }
}
