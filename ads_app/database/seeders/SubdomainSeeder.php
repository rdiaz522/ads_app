<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubdomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subdomains')->insert([
            'id' => generateGUID(),
            'name' => 'alpha',
            'created_at' => today(),
            'updated_at' => today()
        ]);
    }
}
