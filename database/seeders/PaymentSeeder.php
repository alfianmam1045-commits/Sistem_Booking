<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;


class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        Payment::insert([
            [
                'booking_id' => 1,
                'payment_method' => 'transfer',
                'amount' => 250000.00,
                'payment_status' => 'paid',
                'payment_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 2,
                'payment_method' => 'ewallet',
                'amount' => 500000.00,
                'payment_status' => 'pending',
                'payment_date' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
