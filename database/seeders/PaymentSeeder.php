<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;
class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Payment::factory(10)->create(); // for testing

        Payment::create([
            'id' => 1,
            'amount' => '500',
            'client_id' => 1,
            'created_at' => '2025-01-01 17:25:52',
            'updated_at' => '2025-01-01 17:25:52',
        ]);

        Payment::create([
            'id' => 2,
            'amount' => '1000',
            'client_id' => 2,
            'created_at' => '2025-01-02 17:25:52',
            'updated_at' => '2025-01-02 17:25:52',
        ]);

        Payment::create([
            'id' => 3,
            'amount' => '1500',
            'client_id' => 3,
            'created_at' => '2025-02-01 17:25:52',
            'updated_at' => '2025-02-01 17:25:52',
        ]);

        Payment::create([
            'id' => 4,
            'amount' => '2000',
            'client_id' => 3,
            'created_at' => '2025-02-02 17:25:52',
            'updated_at' => '2025-02-02 17:25:52',
        ]);

        Payment::create([
            'id' => 5,
            'amount' => '2500',
            'client_id' => 4,
            'created_at' => '2025-03-01 17:25:52',
            'updated_at' => '2025-03-01 17:25:52',
        ]);

        Payment::create([
            'id' => 6,
            'amount' => '3000',
            'client_id' => 4,
            'created_at' => '2025-03-02 17:25:52',
            'updated_at' => '2025-03-02 17:25:52',
        ]);

    }
}
