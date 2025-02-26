<?php

namespace Database\Seeders;

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
         \App\Models\User::factory()->create([
             'id' => generateGUID(),
             'username' => 'rondev522',
             'email' => 'ronarnie@gmail.com',
             'password' => Hash::make('ron123123'),
         ]);
    }
}
