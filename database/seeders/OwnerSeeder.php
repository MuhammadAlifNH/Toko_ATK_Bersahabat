<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class OwnerSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Owner',
            'email' => 'owner@example.com',
            'password' => Hash::make('owner12345678'), // Ganti dengan password yang diinginkan
            'TTL' => '1995-12-01', // Ganti dengan TTL yang diinginkan
            'jenis_kelamin' => 'L',
            'status' => 2, // Owner status
        ]);
    }
}
