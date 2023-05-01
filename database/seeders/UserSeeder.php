<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = "password";
        User::create([
            'name' => 'Admin Proyecto SSPIS',
            'email' => 'admin@gmail.com',
            'password' => Hash::make($password),
        ])->assignRole('Administrator');

        User::create([
            'name' => 'Leader Proyecto SSPIS',
            'email' => 'leader@gmail.com',
            'password' => Hash::make($password),
        ])->assignRole('Leader');
        
        User::create([
            'name' => 'Worker Proyecto SSPIS',
            'email' => 'worker@gmail.com',
            'password' => Hash::make($password),
        ])->assignRole('Worker');
        
        //User::factory(10)->withPersonalTeam()->create();
    }
}
