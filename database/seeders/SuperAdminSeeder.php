<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\superAdmin;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        superAdmin::create([
            'first_name' => 'Ichraq',
            'last_name' => 'AMINE',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('test'),
        ]);
    }
}
