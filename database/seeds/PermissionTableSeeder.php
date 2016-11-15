<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
$permission = [
[
'name' => 'role-list',
'display_name' => 'Display Role Listing',
'description' => 'See only Listing Of Role'
],
[
'name' => 'role-create',
'display_name' => 'Create Role',
'description' => 'Create New Role'
],
[
'name' => 'role-edit',
'display_name' => 'Edit Role',
'description' => 'Edit Role'
],
[
'name' => 'role-delete',
'display_name' => 'Delete Role',
'description' => 'Delete Role'
],
[
'name' => 'item-list',
'display_name' => 'Display Item Listing',
'description' => 'See only Listing Of Item'
],
[
'name' => 'item-create',
'display_name' => 'Create Item',
'description' => 'Create New Item'
],
[
'name' => 'item-edit',
'display_name' => 'Edit Item',
'description' => 'Edit Item'
],
[
'name' => 'item-delete',
'display_name' => 'Delete Item',
'description' => 'Delete Item'
],
[
'name' => 'user-list',
'display_name' => 'Display user Listing',
'description' => 'See only Listing Of user'
],
[
'name' => 'user-create',
'display_name' => 'Create user',
'description' => 'Create New user'
],
[
'name' => 'user-edit',
'display_name' => 'Edit user',
'description' => 'Edit user'
],
[
'name' => 'user-delete',
'display_name' => 'Delete user',
'description' => 'Delete user'
]
];

    foreach ($permission as $key => $value) {
        Permission::create($value);
    }
}
}