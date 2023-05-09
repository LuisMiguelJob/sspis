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
            'name' => 'Worker Proyecto SSPIS',
            'email' => 'worker@gmail.com',
            'password' => Hash::make($password),
        ])->assignRole('Worker');

        User::create([
            'name' => 'Worker1',
            'email' => 'worker1@gmail.com',
            'password' => Hash::make($password),
        ])->assignRole('Worker');

        User::create([
            'name' => 'Worker2',
            'email' => 'worker2@gmail.com',
            'password' => Hash::make($password),
        ])->assignRole('Worker');

        User::create([
            'name' => 'Worker3',
            'email' => 'worker3@gmail.com',
            'password' => Hash::make($password),
        ])->assignRole('Worker');

        User::create([
            'name' => 'Worker4',
            'email' => 'worker4@gmail.com',
            'password' => Hash::make($password),
        ])->assignRole('Worker');

        User::create([
            'name' => 'Worker5',
            'email' => 'worker5@gmail.com',
            'password' => Hash::make($password),
        ])->assignRole('Worker');
        
        //User::factory(10)->withPersonalTeam()->create();
    }
}
