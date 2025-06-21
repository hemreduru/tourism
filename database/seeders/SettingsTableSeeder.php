<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    public function run(): void
    {
        if (Setting::count() === 0) {
            Setting::create([
                'phone'        => null,
                'email'        => null,
                'whatsapp'     => null,
                'latitude'     => 0,
                'longitude'    => 0,
                'address_en'   => null,
                'address_tr'   => null,
                'address_nl'   => null,
            ]);
        }
    }
}
