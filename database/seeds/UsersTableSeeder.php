<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $seeds = array (
            0 => 
            array (
                'name' => env('ADMIN_NAME'),
                'email' => env('ADMIN_EMAIL'),
                'password' => bcrypt(env('ADMIN_PASSWORD')),
            ),
        );

        $user = User::updateOrCreate(['email' => env('ADMIN_EMAIL')], $seeds[0]);

        if($user->hasRole('admin')){

        }
        else{
            $user->attachRole(1);
            $user->save();
        }
    }
}