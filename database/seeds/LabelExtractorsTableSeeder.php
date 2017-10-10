<?php

use Illuminate\Database\Seeder;

class LabelExtractorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('label_extractors')->delete();
        
        \DB::table('label_extractors')->insert(array (
            0 => 
            array (
                'id' => '1',
                'property' => 'rdfs:label',
                'priority' => '1',
                'enabled' => '1',
                'created_at' => '2016-08-29 12:35:39',
                'updated_at' => '2016-08-29 12:35:39',
            ),
            1 => 
            array (
                'id' => '2',
                'property' => 'foaf:name',
                'priority' => '2',
                'enabled' => '1',
                'created_at' => '2016-08-29 12:35:51',
                'updated_at' => '2016-08-29 12:35:51',
            ),
            2 => 
            array (
                'id' => '3',
                'property' => 'skos:prefLabel',
                'priority' => '3',
                'enabled' => '1',
                'created_at' => '2016-08-29 12:36:05',
                'updated_at' => '2016-08-29 12:36:05',
            ),
            3 => 
            array (
                'id' => '4',
                'property' => 'dc:title',
                'priority' => '4',
                'enabled' => '1',
                'created_at' => '2016-08-29 12:36:18',
                'updated_at' => '2016-08-29 12:36:18',
            ),
        ));
        
        
    }
}