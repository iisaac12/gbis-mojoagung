<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title' => 'Natal Bersama 2025',
                'date' => Carbon::create(2025, 12, 25),
                'description' => 'Perayaan Natal bersama seluruh jemaat GBIS Mojoagung. Acara dimulai pukul 18:00 dengan kebaktian khusus, dilanjutkan dengan drama natalitas, pujian dan penyembahan, serta makan malam bersama. Mari kita rayakan kelahiran Yesus Kristus dengan sukacita!',
                'image_url' => null,
            ],
            [
                'title' => 'Retreat Pemuda 2025',
                'date' => Carbon::now()->addMonths(2),
                'description' => 'Retreat khusus untuk pemuda dan remaja. Tema: "Bangkit dalam Kristus". Kegiatan meliputi renungan, diskusi kelompok, outbound, dan api unggun. Lokasi: Villa Puncak, Jawa Barat. Biaya: Rp 500.000 (sudah termasuk akomodasi dan konsumsi).',
                'image_url' => null,
            ],
            [
                'title' => 'Paskah 2026',
                'date' => Carbon::create(2026, 4, 5),
                'description' => 'Ibadah Paskah spesial merayakan kebangkitan Yesus Kristus. Dimulai dengan ibadah fajar pukul 05:00, dilanjutkan dengan ibadah raya pukul 08:00. Akan ada drama passion, pujian khusus, dan khotbah tentang arti kebangkitan. Seluruh jemaat diundang hadir.',
                'image_url' => null,
            ],
            [
                'title' => 'Seminar Keluarga Kristen',
                'date' => Carbon::now()->addMonth(),
                'description' => 'Seminar tentang membangun keluarga Kristen yang kuat. Pembicara: Pdt. John Doe, M.Th. Topik: Komunikasi dalam Keluarga, Mendidik Anak Menurut Firman Tuhan, Keuangan Keluarga. Gratis untuk seluruh jemaat. Registrasi dibuka mulai hari ini.',
                'image_url' => null,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}