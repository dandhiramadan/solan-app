<?php

namespace Database\Seeders;

use App\Models\Machine;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MachinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $machines = [
            ['id' => '1','machine_identity' => 'Mesin Plate A','type' => 'Mesin Plate','panjang_area_cetak_minimal' => NULL,'lebar_area_cetak_minimal' => NULL,'panjang_area_cetak_maximal' => NULL,'lebar_area_cetak_maximal' => NULL,'panjang_bahan_maximal' => NULL,'lebar_bahan_maximal' => NULL,'created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '2','machine_identity' => 'Mesin 46','type' => 'Mesin Cetak','panjang_area_cetak_minimal' => '18','lebar_area_cetak_minimal' => '11.6','panjang_area_cetak_maximal' => '45','lebar_area_cetak_maximal' => '31','panjang_bahan_maximal' => '0','lebar_bahan_maximal' => '0','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '3','machine_identity' => 'Mesin 52 A','type' => 'Mesin Cetak','panjang_area_cetak_minimal' => '18','lebar_area_cetak_minimal' => '11.6','panjang_area_cetak_maximal' => '50.5','lebar_area_cetak_maximal' => '34.5','panjang_bahan_maximal' => '51.5','lebar_bahan_maximal' => '36.2','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '4','machine_identity' => 'Mesin 52 B','type' => 'Mesin Cetak','panjang_area_cetak_minimal' => '18','lebar_area_cetak_minimal' => '11.6','panjang_area_cetak_maximal' => '50.5','lebar_area_cetak_maximal' => '34.5','panjang_bahan_maximal' => '51.5','lebar_bahan_maximal' => '36.2','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '5','machine_identity' => 'Mesin 52 ALL COLOR','type' => 'Mesin Cetak','panjang_area_cetak_minimal' => '18','lebar_area_cetak_minimal' => '11.6','panjang_area_cetak_maximal' => '50.5','lebar_area_cetak_maximal' => '34.5','panjang_bahan_maximal' => '51.5','lebar_bahan_maximal' => '36.2','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '6','machine_identity' => 'Mesin 58 A (2 WARNA)','type' => 'Mesin Cetak','panjang_area_cetak_minimal' => '25.6','lebar_area_cetak_minimal' => '18.2','panjang_area_cetak_maximal' => '57','lebar_area_cetak_maximal' => '44','panjang_bahan_maximal' => '58','lebar_bahan_maximal' => '45','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '7','machine_identity' => 'Mesin 58 B (2 WARNA)','type' => 'Mesin Cetak','panjang_area_cetak_minimal' => '25.6','lebar_area_cetak_minimal' => '18.2','panjang_area_cetak_maximal' => '57','lebar_area_cetak_maximal' => '44','panjang_bahan_maximal' => '58','lebar_bahan_maximal' => '45','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '8','machine_identity' => 'Mesin 58 A (4 WARNA)','type' => 'Mesin Cetak','panjang_area_cetak_minimal' => '25.6','lebar_area_cetak_minimal' => '18.2','panjang_area_cetak_maximal' => '57','lebar_area_cetak_maximal' => '44','panjang_bahan_maximal' => '58','lebar_bahan_maximal' => '45','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '9','machine_identity' => 'Mesin Cetak Label','type' => 'Mesin Cetak Label','panjang_area_cetak_minimal' => NULL,'lebar_area_cetak_minimal' => NULL,'panjang_area_cetak_maximal' => NULL,'lebar_area_cetak_maximal' => NULL,'panjang_bahan_maximal' => NULL,'lebar_bahan_maximal' => NULL,'created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '10','machine_identity' => 'Mesin Laminating Thermal A','type' => 'Mesin Laminating','panjang_area_cetak_minimal' => NULL,'lebar_area_cetak_minimal' => NULL,'panjang_area_cetak_maximal' => NULL,'lebar_area_cetak_maximal' => NULL,'panjang_bahan_maximal' => NULL,'lebar_bahan_maximal' => NULL,'created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '11','machine_identity' => 'Mesin Laminating Waterbase A','type' => 'Mesin Laminating','panjang_area_cetak_minimal' => NULL,'lebar_area_cetak_minimal' => NULL,'panjang_area_cetak_maximal' => NULL,'lebar_area_cetak_maximal' => NULL,'panjang_bahan_maximal' => NULL,'lebar_bahan_maximal' => NULL,'created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '12','machine_identity' => 'Mesin Vernish A','type' => 'Mesin Vernish','panjang_area_cetak_minimal' => NULL,'lebar_area_cetak_minimal' => NULL,'panjang_area_cetak_maximal' => NULL,'lebar_area_cetak_maximal' => NULL,'panjang_bahan_maximal' => NULL,'lebar_bahan_maximal' => NULL,'created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '13','machine_identity' => 'Mesin Foil A','type' => 'Mesin Foil','panjang_area_cetak_minimal' => NULL,'lebar_area_cetak_minimal' => NULL,'panjang_area_cetak_maximal' => NULL,'lebar_area_cetak_maximal' => NULL,'panjang_bahan_maximal' => NULL,'lebar_bahan_maximal' => NULL,'created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '14','machine_identity' => 'Mesin Sablon A','type' => 'Mesin Sablon','panjang_area_cetak_minimal' => NULL,'lebar_area_cetak_minimal' => NULL,'panjang_area_cetak_maximal' => NULL,'lebar_area_cetak_maximal' => NULL,'panjang_bahan_maximal' => NULL,'lebar_bahan_maximal' => NULL,'created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '15','machine_identity' => 'Mesin Pond A','type' => 'Mesin Pond','panjang_area_cetak_minimal' => NULL,'lebar_area_cetak_minimal' => NULL,'panjang_area_cetak_maximal' => NULL,'lebar_area_cetak_maximal' => NULL,'panjang_bahan_maximal' => NULL,'lebar_bahan_maximal' => NULL,'created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '16','machine_identity' => 'Mesin Pond B','type' => 'Mesin Pond','panjang_area_cetak_minimal' => NULL,'lebar_area_cetak_minimal' => NULL,'panjang_area_cetak_maximal' => NULL,'lebar_area_cetak_maximal' => NULL,'panjang_bahan_maximal' => NULL,'lebar_bahan_maximal' => NULL,'created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '17','machine_identity' => 'Mesin Pond C','type' => 'Mesin Pond','panjang_area_cetak_minimal' => NULL,'lebar_area_cetak_minimal' => NULL,'panjang_area_cetak_maximal' => NULL,'lebar_area_cetak_maximal' => NULL,'panjang_bahan_maximal' => NULL,'lebar_bahan_maximal' => NULL,'created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '18','machine_identity' => 'Mesin Pond D','type' => 'Mesin Pond','panjang_area_cetak_minimal' => NULL,'lebar_area_cetak_minimal' => NULL,'panjang_area_cetak_maximal' => NULL,'lebar_area_cetak_maximal' => NULL,'panjang_bahan_maximal' => NULL,'lebar_bahan_maximal' => NULL,'created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '19','machine_identity' => 'Mesin Pond E','type' => 'Mesin Pond','panjang_area_cetak_minimal' => NULL,'lebar_area_cetak_minimal' => NULL,'panjang_area_cetak_maximal' => NULL,'lebar_area_cetak_maximal' => NULL,'panjang_bahan_maximal' => NULL,'lebar_bahan_maximal' => NULL,'created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '20','machine_identity' => 'Mesin Lem A','type' => 'Mesin Lem','panjang_area_cetak_minimal' => NULL,'lebar_area_cetak_minimal' => NULL,'panjang_area_cetak_maximal' => NULL,'lebar_area_cetak_maximal' => NULL,'panjang_bahan_maximal' => NULL,'lebar_bahan_maximal' => NULL,'created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '21','machine_identity' => 'Mesin Mata Itik A','type' => 'Mesin Mata Itik','panjang_area_cetak_minimal' => NULL,'lebar_area_cetak_minimal' => NULL,'panjang_area_cetak_maximal' => NULL,'lebar_area_cetak_maximal' => NULL,'panjang_bahan_maximal' => NULL,'lebar_bahan_maximal' => NULL,'created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '22','machine_identity' => 'Mesin Hot Cutting A','type' => 'Mesin Hot Cutting','panjang_area_cetak_minimal' => NULL,'lebar_area_cetak_minimal' => NULL,'panjang_area_cetak_maximal' => NULL,'lebar_area_cetak_maximal' => NULL,'panjang_bahan_maximal' => NULL,'lebar_bahan_maximal' => NULL,'created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '23','machine_identity' => 'Mesin Bor A','type' => 'Mesin Bor','panjang_area_cetak_minimal' => NULL,'lebar_area_cetak_minimal' => NULL,'panjang_area_cetak_maximal' => NULL,'lebar_area_cetak_maximal' => NULL,'panjang_bahan_maximal' => NULL,'lebar_bahan_maximal' => NULL,'created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '24','machine_identity' => 'Mesin Potong Jadi A','type' => 'Mesin Potong Jadi','panjang_area_cetak_minimal' => NULL,'lebar_area_cetak_minimal' => NULL,'panjang_area_cetak_maximal' => NULL,'lebar_area_cetak_maximal' => NULL,'panjang_bahan_maximal' => NULL,'lebar_bahan_maximal' => NULL,'created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '25','machine_identity' => 'Mesin Potong Bahan A','type' => 'Mesin Potong Bahan','panjang_area_cetak_minimal' => NULL,'lebar_area_cetak_minimal' => NULL,'panjang_area_cetak_maximal' => NULL,'lebar_area_cetak_maximal' => NULL,'panjang_bahan_maximal' => NULL,'lebar_bahan_maximal' => NULL,'created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '26','machine_identity' => 'Mesin Potong Jadi B','type' => 'Mesin Potong Jadi','panjang_area_cetak_minimal' => NULL,'lebar_area_cetak_minimal' => NULL,'panjang_area_cetak_maximal' => NULL,'lebar_area_cetak_maximal' => NULL,'panjang_bahan_maximal' => NULL,'lebar_bahan_maximal' => NULL,'created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '27','machine_identity' => 'Mesin Plate Label','type' => 'Mesin Plate','panjang_area_cetak_minimal' => NULL,'lebar_area_cetak_minimal' => NULL,'panjang_area_cetak_maximal' => NULL,'lebar_area_cetak_maximal' => NULL,'panjang_bahan_maximal' => NULL,'lebar_bahan_maximal' => NULL,'created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '28','machine_identity' => 'Mesin Thermal B','type' => 'Mesin Thermal','panjang_area_cetak_minimal' => NULL,'lebar_area_cetak_minimal' => NULL,'panjang_area_cetak_maximal' => NULL,'lebar_area_cetak_maximal' => NULL,'panjang_bahan_maximal' => NULL,'lebar_bahan_maximal' => NULL,'created_at' => '2023-09-14 17:29:52','updated_at' => '2023-09-14 17:29:52']
          ];

        foreach ($machines as $data) {
            Machine::create([
                'name' => $data['machine_identity'],
                'type' => $data['type'],
                'panjang_area_cetak_minimal' => $data['panjang_area_cetak_minimal'],
                'lebar_area_cetak_minimal' => $data['lebar_area_cetak_minimal'],
                'panjang_area_cetak_maximal' => $data['panjang_area_cetak_maximal'],
                'lebar_area_cetak_maximal' => $data['lebar_area_cetak_maximal'],
                'panjang_bahan_maximal' => $data['panjang_bahan_maximal'],
                'lebar_bahan_maximal' => $data['lebar_bahan_maximal'],
            ]);
        }
    }
}
