<?php

use Illuminate\Database\Seeder;

class ImageExtractorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('image_extractors')->delete();
        
        \DB::table('image_extractors')->insert(array (
            0 => 
            array (
                'id' => '1',
                'property' => 'foaf:depiction',
                'priority' => '1',
                'enabled' => '1',
                'created_at' => '2016-08-29 12:35:20',
                'updated_at' => '2016-08-29 12:35:20',
            ),
        ));
        
        
    }
}