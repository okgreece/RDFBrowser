<?php

use Illuminate\Database\Seeder;

use App\rdfnamespace;

class RdfnamespacesTableSeeder extends Seeder
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
                    'prefix' => 'dbo-PopulatedPlace',
                    'uri' => 'http://dbpedia.org/ontology/PopulatedPlace/',
                    'added' => '1',
                ),
            1 =>
                array (
                    'prefix' => 'dbo',
                    'uri' => 'http://dbpedia.org/ontology/',
                    'added' => '1',
                ),
            2 =>
                array (
                    'prefix' => 'dbp',
                    'uri' => 'http://dbpedia.org/property/',
                    'added' => '1',
                ),
            3 =>
                array (

                    'prefix' => 'georss',
                    'uri' => 'http://www.georss.org/georss/',
                    'added' => '1',
                ),
            4 =>
                array (
                    'prefix' => 'el-dbp',
                    'uri' => 'http://el.dbpedia.org/property/',
                    'added' => '1',
                ),
            5 =>
                array (
                    'prefix' => 'dbo-Person',
                    'uri' => 'http://dbpedia.org/ontology/Person/',
                    'added' => '1',
                ),
            6 =>
                array (
                    'prefix' => 'yago-class',
                    'uri' => 'http://dbpedia.org/class/yago/',
                    'added' => '1',
                ),
            7 =>
                array (
                    'prefix' => 'db-datatype',
                    'uri' => 'http://dbpedia.org/datatype/',
                    'added' => '1',
                ),

            8 =>
                array (
                    'prefix' => 'obeu-dimension',
                    'uri' => 'http://data.openbudgets.eu/ontology/dsd/dimension/',
                    'added' => '1',
                ),
            9 =>
                array (
                    'prefix' => 'obeu-attribute',
                    'uri' => 'http://data.openbudgets.eu/ontology/dsd/attribute/',
                    'added' => '1',
                ),
            10 =>
                array (
                    'prefix' => 'obeu-measure',
                    'uri' => 'http://data.openbudgets.eu/ontology/dsd/measure/',
                    'added' => '1',
                ),
            11 =>
                array (
                    'prefix' => 'vfp',
                    'uri' => 'http://okfn.gr/ontology/vfp#',
                    'added' => '1',
                ),
            12 =>
                array (
                    'prefix' => 'wn20',
                    'uri' => 'http://www.w3.org/2006/03/wn/wn20/schema/',
                    'added' => '1',
                ),
            13 =>
                array (
                    'prefix' => 'wngre-onto',
                    'uri' => 'http://wordnet.okfn.gr/ontology/',
                    'added' => '1',
                ),
            14 =>
                array (
                    'prefix' => 'gn',
                    'uri' => 'http://www.geonames.org/ontology#',
                    'added' => '1',
                ),
            15 =>
                array (
                    'prefix' => 'adms',
                    'uri' => 'http://www.w3.org/ns/adms#',
                    'added' => '1',
                ),
            ];
        foreach ($seeds as $key => $value) {
            rdfnamespace::firstOrCreate($value);
        }
    }
}