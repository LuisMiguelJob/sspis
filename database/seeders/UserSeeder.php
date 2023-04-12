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
        $password = 'password';
        User::create([ 
            'name' => 'Luis Miguel', 
            'last_name' => 'Hernandez Villalaz', 
            'email' => 'luis@luis',
            'password' => Hash::make($password)
        ]);
        
        User::factory(30)->create();
    }
}
