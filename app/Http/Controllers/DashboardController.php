<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $skillCount = Skill::all()->count();
        $educationCount = Education::all()->count();
        $projectCount = Project::all()->count();
        $projects = Project::orderBy('created_at','DESC')->take(5)->get();
        $experienceCount = Experience::all()->count();
        $userCount = User::all()->count();

        return view('dashboard', compact(
            'skillCount',
            'educationCount',
            'experienceCount',
            'projectCount',
            'userCount',
            'projects'
        ));

    }
}
