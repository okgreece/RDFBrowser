<?php

use Illuminate\Database\Seeder;
use App\GeoExtractor;
class GeoExtractorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            0 => 
            array (
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
            ),
            1 => 
            array (
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
            ),
            2 => 
            array (
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
            ),
        ];

        foreach ($seeds as $key => $value) {
            GeoExtractor::firstOrCreate($value);
        }
    }
}
