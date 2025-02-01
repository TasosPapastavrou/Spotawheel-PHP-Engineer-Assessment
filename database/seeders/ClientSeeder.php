<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Client::factory(10)->create(); //test

        Client::create([
            'id' => 1,
            'name' => 'Taylor',
            'surname' => 'Otwell',
            'created_at' => '2025-01-01 17:25:52',
            'updated_at' => '2025-01-01 17:25:52',
        ]);

        Client::create([
            'id' => 2,
            'name' => 'Taylor',
            'surname' => 'Taylor',
            'created_at' => '2025-01-02 17:25:52',
            'updated_at' => '2025-01-02 17:25:52',
        ]);

        Client::create([
            'id' => 3,
            'name' => 'Jeffrey',
            'surname' => 'Way',
            'created_at' => '2025-02-01 17:25:52',
            'updated_at' => '2025-02-01 17:25:52',
        ]);

        Client::create([
            'id' => 4,
            'name' => 'Phill',
            'surname' => 'Sparks',
            'created_at' => '2025-03-01 17:25:52',
            'updated_at' => '2025-03-01 17:25:52',
        ]);


    }
}

