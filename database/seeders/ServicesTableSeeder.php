<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'name' => 'Plan A',
            'description' => 'Punctual cleaning',
            'price' => '45.00',
            'type' => 1,
        ]);

        Service::create([
            'name' => 'Plan B',
            'description' => 'Final cleaning',
            'price' => '',
            'type' => 0,
        ]);

        Service::create([
            'name' => 'Plan C',
            'description' => 'Floor clean',
            'price' => '25.00',
            'type' => 1,
        ]);
    }
}
