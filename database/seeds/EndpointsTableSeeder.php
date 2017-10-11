<?php

use Illuminate\Database\Seeder;
use App\Endpoint;
class EndpointsTableSeeder extends Seeder
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
                'name' => 'virtuoso',
                'endpoint_url' => env('DEFAULT_ENDPOINT'),
                'local' => '0',
            ),
        ];

        foreach ($seeds as $key => $value) {
            Endpoint::firstOrCreate($value);
        }
        
    }
}