<?php

namespace Database\Seeders;

use App\Models\Laundry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaundrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Laundry::factory(50)->create();
    }
}
