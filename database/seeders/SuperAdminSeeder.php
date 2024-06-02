<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\superAdmin;
use App\Models\UserThese;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserThese::create([
            'first_name' => 'Ichraq',
            'last_name' => 'AMINE',
            'role' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('test'),
        ]);

        superAdmin::create([
            'first_name' => 'Ichraq',
            'last_name' => 'AMINE',
            'role' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('test'),
        ]);
    }
}
