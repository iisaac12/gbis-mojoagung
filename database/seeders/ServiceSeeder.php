<?php
// database/seeders/ServiceSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use Carbon\Carbon;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Ibadah Minggu Pagi',
                'date' => Carbon::now()->next('Sunday'),
                'time_start' => '08:00:00',
                'time_end' => '10:00:00',
                'location' => 'Gedung Gereja Utama',
                'description' => 'Ibadah Minggu pagi dengan khotbah dan pujian.',
                'language' => 'id',
            ],
            [
                'title' => 'Sunday Morning Service',
                'date' => Carbon::now()->next('Sunday'),
                'time_start' => '10:30:00',
                'time_end' => '12:30:00',
                'location' => 'Main Church Building',
                'description' => 'Sunday morning service with sermon and worship.',
                'language' => 'en',
            ],
            [
                'title' => 'Persekutuan Doa',
                'date' => Carbon::now()->next('Wednesday'),
                'time_start' => '19:00:00',
                'time_end' => '21:00:00',
                'location' => 'Ruang Doa',
                'description' => 'Persekutuan doa malam untuk jemaat.',
                'language' => 'both',
            ],
            [
                'title' => 'Sekolah Minggu',
                'date' => Carbon::now()->next('Sunday'),
                'time_start' => '08:00:00',
                'time_end' => '09:30:00',
                'location' => 'Ruang Anak',
                'description' => 'Sekolah Minggu untuk anak-anak usia 5-12 tahun.',
                'language' => 'id',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}