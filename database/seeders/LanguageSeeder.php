<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        $translations = [
            [
                'key' => 'welcome_message',
                'text_id' => 'Selamat Datang di GBIS Mojoagung',
                'text_en' => 'Welcome to GBIS Mojoagung',
            ],
            [
                'key' => 'home',
                'text_id' => 'Beranda',
                'text_en' => 'Home',
            ],
            [
                'key' => 'about',
                'text_id' => 'Tentang',
                'text_en' => 'About',
            ],
            [
                'key' => 'schedules',
                'text_id' => 'Jadwal',
                'text_en' => 'Schedules',
            ],
            [
                'key' => 'events',
                'text_id' => 'Acara',
                'text_en' => 'Events',
            ],
            [
                'key' => 'contact',
                'text_id' => 'Kontak',
                'text_en' => 'Contact',
            ],
            [
                'key' => 'login',
                'text_id' => 'Masuk',
                'text_en' => 'Login',
            ],
            [
                'key' => 'logout',
                'text_id' => 'Keluar',
                'text_en' => 'Logout',
            ],
            [
                'key' => 'vision',
                'text_id' => 'Visi',
                'text_en' => 'Vision',
            ],
            [
                'key' => 'mission',
                'text_id' => 'Misi',
                'text_en' => 'Mission',
            ],
            [
                'key' => 'join_service',
                'text_id' => 'Bergabunglah dalam Ibadah',
                'text_en' => 'Join Our Service',
            ],
            [
                'key' => 'view_all',
                'text_id' => 'Lihat Semua',
                'text_en' => 'View All',
            ],
            [
                'key' => 'send_message',
                'text_id' => 'Kirim Pesan',
                'text_en' => 'Send Message',
            ],
            [
                'key' => 'message_sent',
                'text_id' => 'Pesan Anda telah terkirim!',
                'text_en' => 'Your message has been sent!',
            ],
        ];

        foreach ($translations as $translation) {
            Language::create($translation);
        }
    }
}