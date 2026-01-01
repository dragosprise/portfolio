<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $query = Project::query();
        $projects = $query->orderBy('id', 'DESC')->get();
        return view('admin.projects.index',compact('projects'));
    }
    public function store(Request $request) {
        $data = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:6000',
            'title'  => 'required',
            'description'   => 'required',
            'link' => 'required'
        ]);

        if($request->hasFile('image')){
            $fileName = time().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $fileName);
            $data['image'] = $fileName;
        }

        Project::create($data);
        return redirect()->back()->with('flash_message', 'Project added successfully!');
    }
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $data = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:6000',
            'title' => 'required',
            'description'  => 'required',
            'link'   => 'required'
        ]);
        if($request->hasFile('image')){
            if ($project->image && file_exists(public_path('images/'.$project->image))) {
                unlink(public_path('images/'.$project->image));
            }

            $fileName = time().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $fileName);
            $data['image'] = $fileName;
        }
        $project->update($data);

        return redirect()->back()->with('flash_message', 'Experience updated successfully!');
    }
    public function destroy($id)
    {

        $skill = Project::findOrFail($id);


        $skill->delete();


        return redirect()->route('projects.index')
            ->with('flash_message', 'Project deleted successfully!');
    }
}
