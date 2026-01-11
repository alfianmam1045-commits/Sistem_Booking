<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::insert([
            [
                'service_name' => 'Perawatan Harian',
                'description' => 'Layanan perawatan pasien harian di rumah',
                'price' => 250000.00,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_name' => 'Perawatan Intensif',
                'description' => 'Layanan perawatan intensif oleh perawat profesional',
                'price' => 500000.00,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_name' => 'Konsultasi Kesehatan',
                'description' => 'Konsultasi kondisi kesehatan pasien',
                'price' => 150000.00,
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
