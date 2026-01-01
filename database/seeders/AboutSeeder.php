<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\About;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       About::updateOrCreate(
           ['id'=>1],
           [
               'name' => 'Nume Prenume',
               'title' => 'Junior Laravel Developer',
               'short_bio' => 'Pasionat de backend...',
               'description' => 'Descriere mai lungă...',
               'github_url' => 'https://github.com/username',
               'linkedin_url' => 'https://linkedin.com/in/username',
           ]
       );
    }
}
