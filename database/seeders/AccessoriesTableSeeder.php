<?php

namespace Database\Seeders;

use App\Models\Accessory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AccessoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accessories= [
            ['description' => 'Bor', 'catatan' => null ],
            ['description' => 'Tali', 'catatan' => null ],
            ['description' => 'Mata Itik', 'catatan' => null ],
        ];

        foreach ($accessories as $data) {
            Accessory::create([
                'description' => $data['description'],
                'catatan' => $data['catatan'],
            ]);
        }
    }
}
