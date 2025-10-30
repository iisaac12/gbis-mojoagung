<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChurchInfo;

class ChurchInfoSeeder extends Seeder
{
    public function run(): void
    {
        ChurchInfo::create([
            'name' => 'GBIS Mojoagung',
            'address' => 'Jl. Raya Mojoagung No. 123, Mojoagung, Jombang, Jawa Timur 61482',
            'phone' => '(0321) 123456',
            'email' => 'info@gbismojoagung.org',
            'description' => 'Gereja Bethel Indonesia Sinode Mojoagung adalah gereja yang berdedikasi untuk menyebarkan kasih Kristus kepada dunia.',
            'vision' => 'Menjadi gereja yang memuliakan Tuhan dan menyebarkan kasih-Nya ke seluruh dunia melalui ibadah yang hidup, persekutuan yang erat, dan pelayanan yang nyata.',
            'mission' => 'Membangun murid-murid Kristus yang dewasa rohani melalui pengajaran Firman Tuhan, ibadah yang penuh kuasa, persekutuan yang hangat, dan pelayanan yang mengasihi.',
            'map_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.123456789!2d112.123456!3d-7.123456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMDcnMjQuNCJTIDExMsKwMDcnMjQuNCJF!5e0!3m2!1sen!2sid!4v1234567890" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
        ]);
    }
}