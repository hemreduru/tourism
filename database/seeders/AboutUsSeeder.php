<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    public function run()
    {
        AboutUs::create([
            'title_en' => 'About Vibrante Tourism Health',
            'title_tr' => 'Vibrante Turizm Sağlığı Hakkında',
            'title_nl' => 'Over Vibrante Toerisme Gezondheid',
            'content_en' => 'Vibrante Tourism Health provides premium healthcare services for international travelers. Founded in 2010, we specialize in medical tourism packages combining treatment with luxury accommodations.',
            'content_tr' => 'Vibrante Turizm Sağlığı, uluslararası gezginler için premium sağlık hizmetleri sunmaktadır. 2010 yılında kurulan şirketimiz, tedaviyi lüks konaklamalarla birleştiren medikal turizm paketlerinde uzmanlaşmıştır.',
            'content_nl' => 'Vibrante Toerisme Gezondheid biedt eersteklas gezondheidsdiensten voor internationale reizigers. Opgericht in 2010, zijn we gespecialiseerd in medisch toerismepakketten die behandeling combineren met luxe accommodaties.',
            'is_active' => true
        ]);
    }
}
