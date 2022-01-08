<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Seeder;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Booking::create([
            'user_id' => 2,
            'service_id' => 1,
            'date' => '2022-01-08',
            'time' => '6:00',
        ]);

        Booking::create([
            'user_id' => 2,
            'service_id' => 3,
            'date' => '2022-01-09',
            'time' => '6:00',
        ]);
    }
}
