<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Let's clear the users table first
        User::truncate();
        
        if (app()->environment('local')) 
        {
            $users = [
                [
                    'name' => 'Administrator',
                    'email' => 'admin@test.com',
                    'password' => Hash::make('DontUse_Admin1'),
                    'role' => 'ADMIN',
                ],
                [
                    'name' => 'adder',
                    'email' => 'adder@test.com',
                    'password' => Hash::make('AnyPa$$word'),
                    'role' => 'ADDER',
                ],                
                [
                    'name' => 'user',
                    'email' => 'user@test.com',
                    'password' => Hash::make('AnyPa$$word'),
                    'role' => 'USER',
                ],
            ]; 
            
            foreach($users as $user) {
                User::create($user);
            }
            
        }
    }
}
