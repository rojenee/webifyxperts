<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            LaundrySeeder::class
        ]);
    
        $staffAssigned = false;
    
        for ($i = 1; $i <= 50; $i++) {
            $roleId = $staffAssigned ? 1 : 2; // If staff is assigned, use customer role (1), otherwise staff role (2)
            $staffAssigned = true; // Set to true after the first assignment
    
            DB::table('role_user')->insert([
                'user_id' => $i,
                'role_id' => $roleId
            ]);
        }
    }
    

}
