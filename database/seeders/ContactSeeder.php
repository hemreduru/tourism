<?php

namespace Database\Seeders;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run()
    {
        $contacts = [
            [
                'name' => 'John Smith',
                'email' => 'john@example.com',
                'phone' => '+905551112233',
                'date' => Carbon::today()->addDays(10),
                'time_slot' => '10:00 - 10:30',
                'message_en' => 'I would like to inquire about dental implant options',
                'message_tr' => 'Diş implantı seçenekleri hakkında bilgi almak istiyorum',
                'message_nl' => 'Ik wil graag informatie over tandheelkundige implantaatopties',
                'language' => 'en',
                'is_read' => true,
                'is_responded' => false,
                'status_id' => 1, // Set to 'New' status
            ],
            [
                'name' => 'Ayşe Yılmaz',
                'email' => 'ayse@example.com',
                'phone' => '+905553334455',
                'date' => Carbon::today()->addDays(15),
                'time_slot' => '14:30 - 15:00',
                'message_en' => 'Hair transplant consultation request',
                'message_tr' => 'Saç ekimi danışmanlığı talebi',
                'message_nl' => 'Verzoek om haartransplantatieconsult',
                'language' => 'tr',
                'is_read' => false,
                'is_responded' => false,
                'status_id' => 1, // Set to 'New' status
            ]
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}
