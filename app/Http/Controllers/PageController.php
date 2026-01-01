<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\About;

class PageController extends Controller
{
    public function index()
    {
        $about = About::first();
        $educations = Education::orderBy('id','DESC')->get();
        $experiences = Experience::orderBy('id','DESC')->get();
        $projects = Project::orderBy('id','DESC')->get();
        $projectCount = Project::all()->count();
        $experienceCount = Experience::all()->count();
        $services = Service::orderBy('id','DESC')->with('skills')->get();
        return view('pages.home.index', compact(
            'about',
            'educations',
            'experiences',
            'projects',
            'projectCount',
            'experienceCount',
            'services'
        ));
    }
}
