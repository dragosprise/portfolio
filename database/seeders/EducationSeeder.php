<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Education::updateOrCreate(
            [
                'institution' => 'Ovidius University',
                'period' => '2019-2022',
                'degree' => 'Bachelors degree',
                'department' => 'Computer Science'
            ]
        );
    }
}
