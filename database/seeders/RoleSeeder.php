<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->getRoleElements() as $roles) {
            Role::create([
                'role_name' => $roles
            ]);
        }
    }

    public function getRoleElements(): array
    {
        $roles = ['customer', 'staff'];
        shuffle($roles);
        for ($i = 0; $i < 2; $i++) {
            $result[$i] = $roles[$i];
        }
        sort($result);

        return $result ?? [];
    }
}
