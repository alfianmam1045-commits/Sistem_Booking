<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        Booking::insert([
            [
                'user_id' => 1,
                'service_id' => 1,
                'booking_date' => now()->addDay()->toDateString(),
                'status' => 'pending',
                'total_price' => 250000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'service_id' => 2,
                'booking_date' => now()->addDays(2)->toDateString(),
                'status' => 'confirmed',
                'total_price' => 500000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
