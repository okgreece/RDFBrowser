<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('PermissionTableSeeder');
        $this->call('RoleTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('GeoExtractorsTableSeeder');
        $this->call('RdfnamespacesTableSeeder');
        $this->call('AbstractExtractorsTableSeeder');
        $this->call('ImageExtractorsTableSeeder');
        $this->call('LabelExtractorsTableSeeder');
        $this->call('ResourceClassesTableSeeder');
        $this->call('EndpointsTableSeeder');
    }
}
