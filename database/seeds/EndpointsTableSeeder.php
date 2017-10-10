<?php

use Illuminate\Database\Seeder;

class EndpointsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('endpoints')->delete();
        
        \DB::table('endpoints')->insert(array (
            0 => 
            array (
                'id' => '1',
                'name' => 'virtuoso',
                'endpoint_url' => env('DEFAULT_ENDPOINT'),
                'local' => '0',
                'created_at' => '2017-10-10 12:09:22',
                'updated_at' => '2017-10-10 12:14:39',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}