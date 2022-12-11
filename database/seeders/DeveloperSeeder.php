<?php

namespace Database\Seeders;

use App\Models\Computer;
use App\Models\Developer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Developer::factory()
        ->times(3)
        ->create();

        foreach(Developer::all() as $developer)
        {
            $computers = Computer::inRandomOrder()->take(rand(1,3))->pluck('id');
            $developer->computers()->attach($computers);
        }
    }
}
