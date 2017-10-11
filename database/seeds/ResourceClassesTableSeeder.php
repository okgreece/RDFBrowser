<?php

use Illuminate\Database\Seeder;
use App\ResourceClass;

class ResourceClassesTableSeeder extends Seeder
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
                    'classUrl' => 'http://purl.org/linked-data/cube#DataSet',
                    'enabled' => '1',
                    'pagination' => '1',
                    'pagination_size' => '20',
                ),
            1 =>
                array (
                    'classUrl' => 'http://www.w3.org/2004/02/skos/core#ConceptScheme',
                    'enabled' => '1',
                    'pagination' => '1',
                    'pagination_size' => '20',
                ),
        ];

        foreach ($seeds as $key => $value) {
            ResourceClass::firstOrCreate($value);
        }
    }
}