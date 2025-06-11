<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name'      => 'admin',
                'email'     => 'admin@admin.com',
                'last_name' => 'phelo',
                'phone'     => '01060712196',
                'type'      => 0,
                'password'  => Hash::make('1234'),
            ]
        );
    }
}
