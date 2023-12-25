<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            ['id' => 1, 'user_id'=> 1, 'type'=> null, 'text' => 'Project Hangtag', 'start_date' => '2023-12-25 08:00:00', 'duration' => 10, 'progress' => 0.8, 'parent' => 0],
            ['id' => 2, 'user_id'=> 1, 'type'=> 'task', 'text' => 'Follow Up', 'start_date' => '2023-12-25 08:00:00', 'duration' => 4, 'progress' => 0.5, 'parent' => 1],
            ['id' => 3, 'user_id'=> 1, 'type'=> 'task', 'text' => 'Hitung Bahan', 'start_date' => '2023-12-25 09:00:00', 'duration' => 3, 'progress' => 0.7, 'parent' => 1],
            ['id' => 4, 'user_id'=> 1, 'type'=> 'task', 'text' => 'RAB', 'start_date' => '2023-12-25 10:00:00', 'duration' => 2, 'progress' => 0, 'parent' => 1],
        ]);
    }
}
