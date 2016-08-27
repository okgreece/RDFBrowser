<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEndpointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('endpoints');
        
        Schema::create('endpoints', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('endpoint_url');
            $table->boolean('local');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('endpoints');
    }
}
