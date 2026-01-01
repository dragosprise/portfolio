<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('experiences')->insert(
            [   [
                'company'=>'Helikon',
                'period'=>'2022-2024',
                'title' =>'Instructor IT'
            ],
                [
                    'company'=>'Companie',
                    'period'=>'2000-2025',
                    'title' =>'Smecher'
                ]
            ]
        );
    }
}
