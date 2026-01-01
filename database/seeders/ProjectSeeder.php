<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::updateOrCreate(
            ['id'=>1],
            [
                'image' => 'Nume Prenume',
                'title' => 'Junior Laravel Developer',
                'description' => 'Descriere mai lungă...',
                'link' => 'https://github.com/username',
            ]
        );
    }
}
