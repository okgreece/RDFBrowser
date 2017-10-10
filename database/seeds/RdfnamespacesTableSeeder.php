<?php

use Illuminate\Database\Seeder;

class RdfnamespacesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rdfnamespaces')->delete();
        
        \DB::table('rdfnamespaces')->insert(array (
            0 => 
            array (
                'id' => '1',
                'prefix' => 'dbo-PopulatedPlace',
                'uri' => 'http://dbpedia.org/ontology/PopulatedPlace/',
                'added' => '1',
                'created_at' => '2016-08-29 12:37:57',
                'updated_at' => '2016-08-31 13:02:31',
            ),
            1 => 
            array (
                'id' => '2',
                'prefix' => 'dbo',
                'uri' => 'http://dbpedia.org/ontology/',
                'added' => '1',
                'created_at' => '2016-08-29 12:37:57',
                'updated_at' => '2016-08-31 13:02:44',
            ),
            2 => 
            array (
                'id' => '3',
                'prefix' => 'dbp',
                'uri' => 'http://dbpedia.org/property/',
                'added' => '1',
                'created_at' => '2016-08-29 12:37:57',
                'updated_at' => '2016-08-31 13:02:53',
            ),
            3 => 
            array (
                'id' => '4',
                'prefix' => 'georss',
                'uri' => 'http://www.georss.org/georss/',
                'added' => '1',
                'created_at' => '2016-08-29 12:37:57',
                'updated_at' => '2016-08-31 13:03:02',
            ),
            4 => 
            array (
                'id' => '5',
                'prefix' => 'el-dbp',
                'uri' => 'http://el.dbpedia.org/property/',
                'added' => '1',
                'created_at' => '2016-08-31 13:04:19',
                'updated_at' => '2016-09-02 10:03:41',
            ),
            5 => 
            array (
                'id' => '6',
                'prefix' => 'dbo-Person',
                'uri' => 'http://dbpedia.org/ontology/Person/',
                'added' => '1',
                'created_at' => '2016-08-31 13:13:29',
                'updated_at' => '2016-09-02 10:04:06',
            ),
            6 => 
            array (
                'id' => '7',
                'prefix' => 'yago-class',
                'uri' => 'http://dbpedia.org/class/yago/',
                'added' => '1',
                'created_at' => '2016-09-02 10:05:15',
                'updated_at' => '2016-09-02 10:05:15',
            ),
            7 => 
            array (
                'id' => '8',
                'prefix' => 'db-datatype',
                'uri' => 'http://dbpedia.org/datatype/',
                'added' => '1',
                'created_at' => '2016-09-02 10:05:47',
                'updated_at' => '2016-09-02 10:05:47',
            ),
            8 => 
            array (
                'id' => '9',
                'prefix' => 'null',
                'uri' => 'http://aemet.linkeddata.es/ontology/',
                'added' => '0',
                'created_at' => '2016-09-02 10:13:51',
                'updated_at' => '2016-09-02 10:13:51',
            ),
            9 => 
            array (
                'id' => '10',
                'prefix' => 'null',
                'uri' => 'http://purl.oclc.org/NET/ssnx/ssn#',
                'added' => '0',
                'created_at' => '2016-09-02 10:13:51',
                'updated_at' => '2016-09-02 10:13:51',
            ),
            10 => 
            array (
                'id' => '11',
                'prefix' => 'null',
                'uri' => 'http://de.dbpedia.org/property/',
                'added' => '0',
                'created_at' => '2016-11-15 11:36:59',
                'updated_at' => '2016-11-15 11:36:59',
            ),
            11 => 
            array (
                'id' => '12',
                'prefix' => 'null',
                'uri' => 'http://data.openbudgets.eu/ontology/dsd/dimension/',
                'added' => '0',
                'created_at' => '2017-03-20 11:59:05',
                'updated_at' => '2017-03-20 11:59:05',
            ),
            12 => 
            array (
                'id' => '13',
                'prefix' => 'null',
                'uri' => 'http://data.openbudgets.eu/ontology/dsd/municipality-of-athens/dimension/',
                'added' => '0',
                'created_at' => '2017-03-20 11:59:05',
                'updated_at' => '2017-03-20 11:59:05',
            ),
            13 => 
            array (
                'id' => '14',
                'prefix' => 'null',
                'uri' => 'http://data.openbudgets.eu/ontology/dsd/greek-municipalities/dimension/',
                'added' => '0',
                'created_at' => '2017-03-20 11:59:05',
                'updated_at' => '2017-03-20 11:59:05',
            ),
            14 => 
            array (
                'id' => '15',
                'prefix' => 'null',
                'uri' => 'http://data.openbudgets.eu/ontology/dsd/budget-athens-expenditure-2005/dimension/',
                'added' => '0',
                'created_at' => '2017-03-20 11:59:05',
                'updated_at' => '2017-03-20 11:59:05',
            ),
            15 => 
            array (
                'id' => '16',
                'prefix' => 'null',
                'uri' => 'http://data.openbudgets.eu/ontology/dsd/attribute/',
                'added' => '0',
                'created_at' => '2017-03-20 11:59:05',
                'updated_at' => '2017-03-20 11:59:05',
            ),
            16 => 
            array (
                'id' => '17',
                'prefix' => 'null',
                'uri' => 'http://data.openbudgets.eu/ontology/dsd/measure/',
                'added' => '0',
                'created_at' => '2017-03-20 11:59:05',
                'updated_at' => '2017-03-20 11:59:05',
            ),
            17 => 
            array (
                'id' => '18',
                'prefix' => 'null',
                'uri' => 'http://cordis.okfn.gr/ontology/dsd/dimension/',
                'added' => '0',
                'created_at' => '2017-03-25 15:17:07',
                'updated_at' => '2017-03-25 15:17:07',
            ),
            18 => 
            array (
                'id' => '19',
                'prefix' => 'vfp',
                'uri' => 'http://okfn.gr/ontology/vfp#',
                'added' => '1',
                'created_at' => '2017-03-25 15:17:07',
                'updated_at' => '2017-04-21 07:55:46',
            ),
            19 => 
            array (
                'id' => '20',
                'prefix' => 'null',
                'uri' => 'http://cordis.okfn.gr/ontology/dsd/measure/',
                'added' => '0',
                'created_at' => '2017-03-25 18:22:42',
                'updated_at' => '2017-03-25 18:22:42',
            ),
            20 => 
            array (
                'id' => '21',
                'prefix' => 'null',
                'uri' => 'http://cordis.okfn.gr/resource/classiffication/',
                'added' => '0',
                'created_at' => '2017-03-26 16:53:24',
                'updated_at' => '2017-03-26 16:53:24',
            ),
            21 => 
            array (
                'id' => '22',
                'prefix' => 'null',
                'uri' => 'http://cordis.okfn.gr/ontology/dsd/FP6/dimension/',
                'added' => '0',
                'created_at' => '2017-03-26 16:53:24',
                'updated_at' => '2017-03-26 16:53:24',
            ),
            22 => 
            array (
                'id' => '23',
                'prefix' => 'null',
                'uri' => 'http://cordis.okfn.gr/ontology/dsd/FP7/dimension/',
                'added' => '0',
                'created_at' => '2017-04-04 14:20:43',
                'updated_at' => '2017-04-04 14:20:43',
            ),
            23 => 
            array (
                'id' => '24',
                'prefix' => 'wn20',
                'uri' => 'http://www.w3.org/2006/03/wn/wn20/schema/',
                'added' => '1',
                'created_at' => '2017-04-04 16:42:31',
                'updated_at' => '2017-04-21 07:55:31',
            ),
            24 => 
            array (
                'id' => '25',
                'prefix' => 'wngre-onto',
                'uri' => 'http://wordnet.okfn.gr/ontology/',
                'added' => '1',
                'created_at' => '2017-04-04 16:42:38',
                'updated_at' => '2017-04-21 07:55:10',
            ),
            25 => 
            array (
                'id' => '26',
                'prefix' => 'null',
                'uri' => 'http://www.geonames.org/ontology#',
                'added' => '0',
                'created_at' => '2017-05-12 13:27:14',
                'updated_at' => '2017-05-12 13:27:14',
            ),
            26 => 
            array (
                'id' => '27',
                'prefix' => 'null',
                'uri' => 'http://purl.org/vocab/vann/',
                'added' => '0',
                'created_at' => '2017-05-12 13:28:09',
                'updated_at' => '2017-05-12 13:28:09',
            ),
            27 => 
            array (
                'id' => '28',
                'prefix' => 'null',
                'uri' => 'http://www.w3.org/ns/adms#',
                'added' => '0',
                'created_at' => '2017-05-12 13:28:09',
                'updated_at' => '2017-05-12 13:28:09',
            ),
            28 => 
            array (
                'id' => '29',
                'prefix' => 'null',
                'uri' => 'http://data.openbudgets.eu/ontology/dsd/europe-greece-municipality-thessaloniki-2016-revenue/dimension/',
                'added' => '0',
                'created_at' => '2017-05-12 14:30:38',
                'updated_at' => '2017-05-12 14:30:38',
            ),
            29 => 
            array (
                'id' => '30',
                'prefix' => 'null',
                'uri' => 'http://data.openbudgets.eu/ontology/dsd/europe-greece-municipality-thessaloniki-2016-revenue/measure/',
                'added' => '0',
                'created_at' => '2017-05-12 14:31:04',
                'updated_at' => '2017-05-12 14:31:04',
            ),
            30 => 
            array (
                'id' => '31',
                'prefix' => 'null',
                'uri' => 'http://schemas.frictionlessdata.io/fiscal-data-package#',
                'added' => '0',
                'created_at' => '2017-05-12 14:34:15',
                'updated_at' => '2017-05-12 14:34:15',
            ),
            31 => 
            array (
                'id' => '32',
                'prefix' => 'null',
                'uri' => 'http://',
                'added' => '0',
                'created_at' => '2017-06-23 13:57:30',
                'updated_at' => '2017-06-23 13:57:30',
            ),
            32 => 
            array (
                'id' => '33',
                'prefix' => 'null',
                'uri' => '_:',
                'added' => '0',
                'created_at' => '2017-06-23 13:57:30',
                'updated_at' => '2017-06-23 13:57:30',
            ),
        ));
        
        
    }
}