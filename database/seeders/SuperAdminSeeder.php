<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Raw SQL as assignment demands
        DB::table('users')->insert([
            'name'       => 'Super Admin',
            'email'      => 'superadmin@example.com',
            'password'   => Hash::make('password'),
            'role'       => 'SuperAdmin',
            'company_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
