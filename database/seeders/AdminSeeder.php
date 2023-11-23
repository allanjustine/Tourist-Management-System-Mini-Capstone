<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'profile_image'=> null,
            'name' => 'Admin',
            'address'=> 'Cebu',
            'phone'=> '09123451231',
            'age'=> '25',
            'gender'=> 'Male',
            'birthday'=> 'March 20, 2000',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password123')
        ])->assignRole('Admin', 'User')
            ->givePermissionTo('manage-all','manage-posts',);

        User::factory()->create([
            'profile_image'=> null,
            'name' => 'Juan Dela Cruz',
            'address'=> 'Manila',
            'phone'=> '09240194921',
            'age'=> '20',
            'gender'=> 'Male',
            'birthday'=> 'April 10, 2001',
            'email' => 'juan@gmail.com',
            'password' => bcrypt('password123')
        ])->assignRole('User')
            ->givePermissionTo('manage-posts');
    }
}
