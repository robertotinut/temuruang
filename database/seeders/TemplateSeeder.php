<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil event_type berdasarkan namanya
        $eventTypeWedding = \App\Models\EventType::where('name', 'Pernikahan')->first();
        $eventTypeBirthday = \App\Models\EventType::where('name', 'Ulang Tahun')->first();
        $eventTypeSeminar = \App\Models\EventType::where('name', 'Seminar')->first();

        $templates = [
            [
                'name' => 'Wedding 01',
                'slug' => 'wedding-01',
                'description' => 'Template undangan pernikahan statis elegan',
                'is_premium' => false,
                'is_active' => true,
                'event_type_id' => $eventTypeWedding?->id,
            ],
            [
                'name' => 'Wedding 02',
                'slug' => 'wedding-02',
                'description' => 'Template undangan pernikahan modern rosy gold',
                'is_premium' => false,
                'is_active' => true,
                'event_type_id' => $eventTypeWedding?->id,
            ],
            [
                'name' => 'Wedding 03',
                'slug' => 'wedding-03',
                'description' => 'Template undangan pernikahan tema biru pastel',
                'is_premium' => false,
                'is_active' => true,
                'event_type_id' => $eventTypeWedding?->id,
            ],
            [
                'name' => 'Birthday 01',
                'slug' => 'birthday-01',
                'description' => 'Template undangan ulang tahun yang ceria dan colorful',
                'is_premium' => false,
                'is_active' => true,
                'event_type_id' => $eventTypeBirthday?->id,
            ],
            [
                'name' => 'Seminar 01',
                'slug' => 'seminar-01',
                'description' => 'Template registrasi acara seminar atau workshop profesional',
                'is_premium' => false,
                'is_active' => true,
                'event_type_id' => $eventTypeSeminar?->id,
            ],
        ];

        foreach ($templates as $template) {
            \App\Models\Template::updateOrCreate(
                ['slug' => $template['slug']],
                $template
            );
        }
    }
}
