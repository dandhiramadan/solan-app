<?php

namespace Database\Seeders;

use App\Models\WorkStep;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WorkStepsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $work_steps = [
            ['id' => '1','description' => 'Follow Up','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '4','description' => 'Cari/Ambil Stock','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '5','description' => 'Hitung Bahan','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '3','description' => 'RAB','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '2','description' => 'Penjadwalan','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '6','description' => 'Setting','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '37','description' => 'Checker','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '7','description' => 'Plate','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '8','description' => 'Potong Bahan','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '9','description' => 'Potong Jadi','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '10','description' => 'Cetak','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '11','description' => 'Sortir','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '13','description' => 'Bor','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '14','description' => 'Tali','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '15','description' => 'Vernish Doff','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '16','description' => 'Vernish Gloss','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '17','description' => 'Laminating Doff','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '18','description' => 'Laminating Gloss','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '12','description' => 'Cetak Label','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '19','description' => 'Hot Cutting','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '20','description' => 'Hot Cutting Folding','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '21','description' => 'Lipat Perahu','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '22','description' => 'Lipat Kanan Kiri','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '23','description' => 'Sablon','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '24','description' => 'Pond','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '25','description' => 'Emboss','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '26','description' => 'Deboss','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '27','description' => 'Rail','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '28','description' => 'Foil','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '29','description' => 'Perforasi','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '30','description' => 'UV','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '31','description' => 'Spot UV','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '32','description' => 'Blok Lem','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '33','description' => 'Lem Lainnya','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '34','description' => 'Mata Itik + Pasang','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '35','description' => 'Qc Packing','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '36','description' => 'Pengiriman','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '38','description' => 'Potong Sample','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '39','description' => 'Maklun','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '40','description' => 'Sortir Barang Keluar','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '41','description' => 'Sortir Barang Masuk','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '42','description' => 'Laminating Metalize','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '43','description' => 'Laminating Lubang','created_at' => '2023-07-30 18:23:41','updated_at' => '2023-07-30 18:23:41'],
            ['id' => '44','description' => 'Pengeringan','created_at' => NULL,'updated_at' => NULL],
            ['id' => '45','description' => 'Lipat Pinggir','created_at' => NULL,'updated_at' => NULL],
            ['id' => '46','description' => 'Laser','created_at' => NULL,'updated_at' => NULL],
            ['id' => '47','description' => 'Vernish Dusting','created_at' => '2023-09-14 17:28:47','updated_at' => '2023-09-14 17:28:47'],
            ['id' => '48','description' => 'Serit','created_at' => NULL,'updated_at' => NULL]
          ];


        foreach ($work_steps as $data) {
            WorkStep::create([
                'description' => $data['description'],
            ]);
        }
    }
}
