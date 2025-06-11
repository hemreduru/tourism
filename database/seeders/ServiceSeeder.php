<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'service_name_en' => 'Dental Implants',
                'service_name_tr' => 'Diş İmplantları',
                'service_name_nl' => 'Tandheelkundige Implantaten',
                'short_description_en' => 'Premium dental implant procedures with world-class specialists',
                'short_description_tr' => 'Dünya standartlarında uzmanlarla premium diş implantı prosedürleri',
                'short_description_nl' => 'Premium tandheelkundige implantaten procedures met wereldklasse specialisten',
                'content_en' => 'Our dental implant services use the highest quality materials and newest techniques for lasting results. Includes consultation, procedure and follow-up care.',
                'content_tr' => 'Diş implantı hizmetlerimizde en kaliteli malzemeler ve en yeni teknikler kullanılmaktadır. Danışmanlık, prosedür ve takip bakımını içerir.',
                'content_nl' => 'Onze tandheelkundige implantatendiensten gebruiken materialen van de hoogste kwaliteit en nieuwste technieken voor blijvende resultaten. Inclusief consultatie, procedure en nazorg.',
                'image_path' => 'services/dental-implants.jpg',
                'is_active' => true
            ],
            [
                'service_name_en' => 'Hair Transplantation',
                'service_name_tr' => 'Saç Ekimi',
                'service_name_nl' => 'Haartransplantatie',
                'short_description_en' => 'Natural-looking hair restoration with FUE technique',
                'short_description_tr' => 'FUE tekniği ile doğal görünümlü saç restorasyonu',
                'short_description_nl' => 'Natuurlijk uitziend haarherstel met FUE-techniek',
                'content_en' => 'Advanced FUE hair transplantation performed by experienced surgeons. Includes pre-op analysis, procedure and 1 year follow-up.',
                'content_tr' => 'Deneyimli cerrahlar tarafından uygulanan ileri FUE saç ekimi. Operasyon öncesi analiz, prosedür ve 1 yıllık takibi içerir.',
                'content_nl' => 'Geavanceerde FUE-haartransplantatie uitgevoerd door ervaren chirurgen. Inclusief pre-operatieve analyse, procedure en 1 jaar nazorg.',
                'image_path' => 'services/hair-transplant.jpg',
                'is_active' => true
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
