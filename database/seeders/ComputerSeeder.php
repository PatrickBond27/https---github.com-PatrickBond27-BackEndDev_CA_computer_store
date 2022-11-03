<?php

namespace Database\Seeders;

use App\Models\Computer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ComputerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeds the data itself into the database
        Computer::factory()->times(50)->create();
    }
}
