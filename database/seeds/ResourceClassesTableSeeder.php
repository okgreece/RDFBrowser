<?php

use Illuminate\Database\Seeder;

class ResourceClassesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('resource_classes')->delete();
        
        \DB::table('resource_classes')->insert(array (
            0 => 
            array (
                'id' => '1',
                'classUrl' => 'http://purl.org/linked-data/cube#DataSet',
                'enabled' => '1',
                'pagination' => '1',
                'pagination_size' => '20',
                'created_at' => '2017-10-10 10:59:35',
                'updated_at' => '2017-10-10 10:59:35',
            ),
            1 => 
            array (
                'id' => '2',
                'classUrl' => 'http://www.w3.org/2004/02/skos/core#ConceptScheme',
                'enabled' => '1',
                'pagination' => '1',
                'pagination_size' => '20',
                'created_at' => '2017-10-10 11:00:07',
                'updated_at' => '2017-10-10 11:00:07',
            ),
        ));
        
        
    }
}