<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;

class RoleTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{

$roles = [
    [
            'name' => 'admin',
        'display_name' => 'Administrator',
        'description' => 'User is allowed to manage and edit EVERYTHING'
    ],
    [
        'name' => 'view',
        'display_name' => 'Viewer',
        'description' => 'User is allowed to view '
    ],
    [
        'name' => 'manage',
        'display_name' => 'Manager',
        'description' => 'User is allowed to manage items, roles, permissions '
    ]           
];

foreach ($roles as $key => $value) {
    Role::create($value);
}


$tt=Role::all()->first();

$tt->attachPermission(1);
$tt->attachPermission(2);
$tt->attachPermission(3);
$tt->attachPermission(4);
$tt->attachPermission(5);
$tt->attachPermission(6);
$tt->attachPermission(7);
$tt->attachPermission(8);
$tt->attachPermission(9);
$tt->attachPermission(10);
$tt->attachPermission(11);
$tt->attachPermission(12);
$tt->save();

$tt=Role::find(2);
$tt->attachPermission(1);
$tt->attachPermission(5);
$tt->attachPermission(9);
$tt->save();

$tt=Role::find(3);
$tt->attachPermission(1);
$tt->attachPermission(2);
$tt->attachPermission(3);
$tt->attachPermission(4);
$tt->attachPermission(5);
$tt->attachPermission(6);
$tt->attachPermission(7);
$tt->attachPermission(8);
$tt->attachPermission(9);   
$tt->save();
}
}
?>