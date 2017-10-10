<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => '1',
                'name' => env('ADMIN_NAME'),
                'email' => env('ADMIN_EMAIL'),
                'password' => bcrypt(env('ADMIN_PASSWORD')),
                'remember_token' => '',
                'created_at' => '2016-08-13 13:20:38',
                'updated_at' => '2016-09-03 09:00:10',
            ),
        ));
        
        \DB::table('role_user')->insert(array (
            0 => 
            array (
                'user_id' => '1',
                'role_id' => '1',
            ),
        ));
        
    }
}