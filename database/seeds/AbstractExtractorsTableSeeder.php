<?php

use Illuminate\Database\Seeder;
use App\AbstractExtractor;

class AbstractExtractorsTableSeeder extends Seeder
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
                'property' => 'rdfs:comment',
                'priority' => '1',
                'enabled' => '1',
            ),
            1 => 
            array (
                'property' => 'dbo:abstract',
                'priority' => '2',
                'enabled' => '1',
            ),
        ];

        foreach ($seeds as $key => $value) {
            AbstractExtractor::firstOrCreate($value);
        }
    }
}