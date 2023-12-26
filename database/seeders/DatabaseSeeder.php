<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\TasksTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\MachinesTableSeeder;
use Database\Seeders\CustomersTableSeeder;
use Database\Seeders\WorkStepsTableSeeder;
use Database\Seeders\InstructionsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(CustomersTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MachinesTableSeeder::class);
        // $this->call(InstructionsTableSeeder::class);
        $this->call(WorkStepsTableSeeder::class);
        // $this->call(TasksTableSeeder::class);
    }
}
