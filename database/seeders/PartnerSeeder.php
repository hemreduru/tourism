<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run()
    {
        $partners = [
            [
                'company_name_en' => 'European Dental Network',
                'company_name_tr' => 'Avrupa Diş Ağı',
                'company_name_nl' => 'Europees Tandheelkundig Netwerk',
                'description_en' => 'Leading dental care provider with clinics across Europe',
                'description_tr' => 'Avrupa genelinde klinikleri bulunan önde gelen diş bakım sağlayıcısı',
                'description_nl' => 'Toonaangevende tandheelkundige zorgaanbieder met klinieken in heel Europa',
                'logo_path' => 'partners/european-dental.png',
                'website' => 'https://europeandental.com',
                'is_active' => true,
                'order' => 1
            ],
            [
                'company_name_en' => 'MedTour Global',
                'company_name_tr' => 'MedTour Global',
                'company_name_nl' => 'MedTour Wereldwijd',
                'description_en' => 'International medical tourism facilitator since 2008',
                'description_tr' => '2008\'den beri uluslararası medikal turizm kolaylaştırıcısı',
                'description_nl' => 'Internationale medische toerismefacilitator sinds 2008',
                'logo_path' => 'partners/medtour-global.png',
                'website' => 'https://medtourglobal.com',
                'is_active' => true,
                'order' => 2
            ]
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
