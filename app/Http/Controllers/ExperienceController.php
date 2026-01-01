<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index(Request $request){
        $query = Experience::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('company', 'LIKE', "%{$search}%")
                ->orWhere('title', 'LIKE', "%{$search}%");
        }

        $experiences = $query->orderBy('id', 'DESC')->get();
        return view('admin.experience.index', compact('experiences'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'company' => 'required',
            'period'  => 'required',
            'title'   => 'required'
        ]);

        Experience::create($data);
        return redirect()->back()->with('flash_message', 'Experience added!');
    }
    public function update(Request $request, $id)
    {
        $experience = Experience::findOrFail($id);
        $request->validate([
            'company' => 'required',
            'period'  => 'required',
            'title'   => 'required'
        ]);

        $experience->update($request->all());

        return redirect()->back()->with('flash_message', 'Experience updated successfully!');
    }
    public function destroy($id)
    {
        $skill = Experience::findOrFail($id);
        $skill->delete();
        return redirect()->route('admin.experience.index')
            ->with('flash_message', 'Experience deleted successfully!');
    }
}
