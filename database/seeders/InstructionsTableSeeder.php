<?php

namespace Database\Seeders;

use App\Models\Instruction;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InstructionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instructions = [
            ['id' => '1','spk_number' => 'SLN23-10536-A','spk_type' => 'production','taxes_type' => 'pajak','spk_state' => 'New','repeat_from' => NULL,'request_kekurangan' => NULL,'spk_parent' => 0,'sub_spk' => 'sub','spk_fsc' => NULL,'spk_number_fsc' => NULL,'fsc_type' => NULL,'order_date' => '2023-06-05','shipping_date' => '2023-06-10','customer_name' => 'KOKIKA DENIM KREATIF, PT.','customer_number' => 'PO2023/06/001','order_name' => 'Hangtag Gabs + Tali Jagger 35.5 Cm','code_style' => '1294A','quantity' => '2450','stock' => NULL,'follow_up' => 'Yanti','panjang_barang' => NULL,'lebar_barang' => NULL,'ukuran_barang' => NULL,'spk_layout_number' => NULL,'spk_sample_number' => NULL,'spk_stock_number' => NULL,'price' => '414','group_id' => NULL,'group_priority' => NULL,'type_order' => 'production','shipping_date_first' => NULL,'type_ppn' => NULL,'ppn' => NULL,'created_at' => '2023-07-30 18:23:28','updated_at' => '2023-07-30 18:23:28'],
          ];



        foreach ($instructions as $data) {
            Instruction::create([
                // 'condition' => $data['spk_state'],
                'spk_number' => $data['spk_number'],
                'spk_type' => $data['spk_type'],
                'taxes_type' => $data['taxes_type'],
                'spk_parent' => $data['spk_parent'],
            ]);
        }
    }
}
