<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChurchInfo;

class ChurchInfoSeeder extends Seeder
{
    public function run(): void
    {
        ChurchInfo::updateOrCreate(
        ['name' => 'GBIS Mojoagung'],
        [
            'address' => 'Jl. Raya Mojoagung No.283, Ngemplak Utara, Mojotrisno, Kec. Mojoagung, Kabupaten Jombang, Jawa Timur 61482',
            'phone' => '(0321) 123456',
            'email' => 'gbismojoagung321@gmail.com',
            'description' => 'Gereja Bethel Indonesia Sinode Mojoagung adalah gereja yang berdedikasi untuk menyebarkan kasih Kristus kepada dunia.',
            'vision' => 'Menjadi gereja yang memuliakan Tuhan dan menyebarkan kasih-Nya ke seluruh dunia melalui ibadah yang hidup, persekutuan yang erat, dan pelayanan yang nyata.',
            'mission' => 'Membangun murid-murid Kristus yang dewasa rohani melalui pengajaran Firman Tuhan, ibadah yang penuh kuasa, persekutuan yang hangat, dan pelayanan yang mengasihi.',
            'map_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.0442510698817!2d112.34804047415163!3d-7.5701548747699015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e786d0043780855%3A0xf0581cf8c50b320e!2sGBIS%20MOJOAGUNG!5e0!3m2!1sid!2sid!4v1762258249437!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
        ]
        );
    }
}