<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMIMEsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_i_m_es', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mime');
            $table->string('format');
            $table->string('extension');
            $table->boolean('enabled');
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
        Schema::drop('m_i_m_es');
    }
}
