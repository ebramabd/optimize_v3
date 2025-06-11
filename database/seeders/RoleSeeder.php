<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Role::where('name', 'admin_company')->where('guard_name', 'web')->exists()) {
            Role::where('name', 'admin_company')->where('guard_name', 'web')->delete();
        }

        $roles = [
            ['name' => 'admin_panel', 'guard_name' => 'web'],
            ['name' => 'admin_company', 'guard_name' => 'company']
        ];

        foreach ($roles as $roleData) {
            // Only create the role if it does not exist
            if (!Role::where('name', $roleData['name'])->where('guard_name', $roleData['guard_name'])->exists()) {
                Role::create($roleData);
            }
        }
    }
}
