<?php

use Illuminate\Database\Seeder;
use App\LabelExtractor;

class LabelExtractorsTableSeeder extends Seeder
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
                    'property' => 'rdfs:label',
                    'priority' => '1',
                    'enabled' => '1',
                ),
            1 =>
                array (
                    'property' => 'foaf:name',
                    'priority' => '2',
                    'enabled' => '1',
                ),
            2 =>
                array (
                    'property' => 'skos:prefLabel',
                    'priority' => '3',
                    'enabled' => '1',
                ),
            3 =>
                array (
                    'property' => 'dc:title',
                    'priority' => '4',
                    'enabled' => '1',
                ),
        ];

        foreach ($seeds as $key => $value) {
            LabelExtractor::firstOrCreate($value);
        }
        
        
    }
}