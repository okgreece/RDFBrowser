<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddGraphFieldsToGraphsTable extends Migration {

    /**
     * Make changes to the table.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('graphs', function(Blueprint $table) {

            $table->string('graph_file_name')->nullable();
            $table->integer('graph_file_size')->nullable()->after('graph_file_name');
            $table->string('graph_content_type')->nullable()->after('graph_file_size');
            $table->timestamp('graph_updated_at')->nullable()->after('graph_content_type');

        });

    }

    /**
     * Revert the changes to the table.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('graphs', function(Blueprint $table) {

            $table->dropColumn('graph_file_name');
            $table->dropColumn('graph_file_size');
            $table->dropColumn('graph_content_type');
            $table->dropColumn('graph_updated_at');

        });
    }

}