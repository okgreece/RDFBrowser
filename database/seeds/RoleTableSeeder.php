<?php

use Illuminate\Database\Seeder;
use App\Role;

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
            Role::firstOrCreate($value);
        }


        $tt = Role::find(1);

        $admin = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        if ($tt->perms->count() === 12) {

        } else {
            $tt->detachPermissions($admin);
            $tt->attachPermissions($admin);
            $tt->save();
        }

        $tt = Role::find(2);

        $viewer = [1, 5, 9];
        if ($tt->perms->count() === 3) {

        } else {
            $tt->detachPermissions($viewer);
            $tt->attachPermissions($viewer);
            $tt->save();
        }


        $tt = Role::find(3);
        $manager = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        if ($tt->perms->count() === 9) {

        } else {
            $tt->detachPermissions($manager);
            $tt->attachPermissions($manager);
            $tt->save();
        }
    }
}
?>