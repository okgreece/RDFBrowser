<?php

use Illuminate\Database\Seeder;

class GeoExtractorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('geo_extractors')->delete();
        
        \DB::table('geo_extractors')->insert(array (
            0 => 
            array (
                'id' => '1',
                'title' => 'geo1',
                'type' => 'dual',
                'generic' => '',
                'genericFormat' => '',
                'lat' => 'http://www.w3.org/2003/01/geo/wgs84_pos#lat',
                'latFormat' => 'http://www.w3.org/2001/XMLSchema#float',
                'long' => 'http://www.w3.org/2003/01/geo/wgs84_pos#long',
                'longFormat' => 'http://www.w3.org/2001/XMLSchema#float',
                'enabled' => '1',
                'order' => '1',
                'created_at' => '2016-08-13 13:30:08',
                'updated_at' => '2016-08-13 13:30:08',
            ),
            1 => 
            array (
                'id' => '2',
                'title' => 'point',
                'type' => 'single',
                'generic' => 'http://www.w3.org/2003/01/geo/wgs84_pos#geometry',
            'genericFormat' => '/POINT\\((-?\\d+.?\\d+)(\\s+)(-?\\d+.?\\d+)\\)/',
                'lat' => '3',
                'latFormat' => '',
                'long' => '1',
                'longFormat' => '',
                'enabled' => '1',
                'order' => '2',
                'created_at' => '2016-08-16 08:09:12',
                'updated_at' => '2016-08-16 08:32:50',
            ),
            2 => 
            array (
                'id' => '3',
                'title' => 'geo2',
                'type' => 'single',
                'generic' => 'http://www.georss.org/georss/point',
            'genericFormat' => '/(-?\\d+.?\\d+)(\\s+)(-?\\d+.?\\d+)/',
                'lat' => '1',
                'latFormat' => '',
                'long' => '3',
                'longFormat' => '',
                'enabled' => '1',
                'order' => '3',
                'created_at' => '2016-08-16 08:35:05',
                'updated_at' => '2016-08-16 08:35:05',
            ),
        ));
        
        
    }
}
