<?php

use Illuminate\Database\Seeder;
use App\ImageExtractor;
class ImageExtractorsTableSeeder extends Seeder
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
                    'id' => '1',
                    'property' => 'foaf:depiction',
                    'priority' => '1',
                    'enabled' => '1',
                    'created_at' => '2016-08-29 12:35:20',
                    'updated_at' => '2016-08-29 12:35:20',
                ),
            ];

        foreach ($seeds as $key => $value) {
            ImageExtractor::firstOrCreate($value);
        }
        
    }
}