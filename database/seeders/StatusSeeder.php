<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name_en' => 'New',
                'name_tr' => 'Yeni',
                'name_nl' => 'Nieuw',
                'color' => '#007bff', // mavi
            ],
            [
                'name_en' => 'In Progress',
                'name_tr' => 'İşlemde',
                'name_nl' => 'In Behandeling',
                'color' => '#17a2b8', // açık mavi
            ],
            [
                'name_en' => 'Completed',
                'name_tr' => 'Tamamlandı',
                'name_nl' => 'Voltooid',
                'color' => '#28a745', // yeşil
            ],
            [
                'name_en' => 'Cancelled',
                'name_tr' => 'İptal',
                'name_nl' => 'Geannuleerd',
                'color' => '#dc3545', // kırmızı
            ],
        ];

        foreach ($statuses as $status) {
            \DB::table('statuses')->insert($status);
        }
    }
}
