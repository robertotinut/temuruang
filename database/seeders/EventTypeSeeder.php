<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Pernikahan', 'description' => 'Acara pernikahan'],
            ['name' => 'Reuni', 'description' => 'Acara reuni akbar atau angkatan'],
            ['name' => 'Ulang Tahun', 'description' => 'Acara ulang tahun'],
            ['name' => 'Wisuda', 'description' => 'Perayaan kelulusan'],
            ['name' => 'Seminar', 'description' => 'Acara edukasi dan seminar'],
            ['name' => 'Gathering', 'description' => 'Kumpul keluarga atau perusahaan'],
            ['name' => 'Komunitas', 'description' => 'Acara komunitas'],
            ['name' => 'Lainnya', 'description' => 'Acara lainnya'],
        ];

        foreach ($types as $type) {
            \App\Models\EventType::create($type);
        }
    }
}
