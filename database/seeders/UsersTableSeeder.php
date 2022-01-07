<?php

namespace Database\Seeders;

use Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Eva',
            'last_name' => 'Rodriguez',
            'phone' => '+0000000',
            'address' => 'Caracas',
            'city' => 'Caracas',
            'zipcode' => '1080',
            'email' => 'admin@web.com',
            'password' => Bcrypt('qwerty123'),
            'user_type' => 'Super',
            'last_login' => Carbon\Carbon::now(),
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
            'email_verified_at' => Carbon\Carbon::now()
        ]);

        User::create([
            'first_name' => 'Joseph',
            'last_name' => 'Bakhos',
            'phone' => '+584242748346',
            'address' => 'Calle Zamora',
            'city' => 'Cúa',
            'zipcode' => '1211',
            'email' => 'josephbakhos@gmail.com',
            'password' => Bcrypt('qwerty123'),
            'user_type' => 'User',
            'last_login' => Carbon\Carbon::now(),
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
            'email_verified_at' => Carbon\Carbon::now()
        ]);
    }
}
