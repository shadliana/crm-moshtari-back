<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EnumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('enum')->insert([
            [
                'name' => 'User',
                'enum' => 'USER',
            ],
            [
                'name' => 'Manager',
                'enum' => 'MANAGER',
            ],
            [
                'name' => 'New',
                'enum' => 'NEW',
            ],
            [
                'name' => 'Win',
                'enum' => 'WIN',
            ],
            [
                'name' => 'Processing',
                'enum' => 'PROCESSING',
            ],
            [
                'name' => 'Lose',
                'enum' => 'LOSE',
            ],
        ]);
    }
}
