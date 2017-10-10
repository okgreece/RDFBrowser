<?php

use Illuminate\Database\Seeder;

class AbstractExtractorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('abstract_extractors')->delete();
        
        \DB::table('abstract_extractors')->insert(array (
            0 => 
            array (
                'id' => '1',
                'property' => 'rdfs:comment',
                'priority' => '1',
                'enabled' => '1',
                'created_at' => '2016-08-29 12:36:34',
                'updated_at' => '2016-08-29 12:36:34',
            ),
            1 => 
            array (
                'id' => '2',
                'property' => 'dbo:abstract',
                'priority' => '2',
                'enabled' => '1',
                'created_at' => '2016-08-29 12:36:55',
                'updated_at' => '2016-08-29 12:36:55',
            ),
        ));
        
        
    }
}