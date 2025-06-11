<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignRolesToUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::get();
        foreach ($users as $user){
            if ($user->type == UserType::Admin){
                if (!$user->hasRole('admin_panel')) {
                    $user->assignRole('admin_panel');
                }
            }
        }
    }
}
