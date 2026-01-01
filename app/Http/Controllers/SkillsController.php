<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Models\Service;


class SkillsController extends Controller
{
    public function index(Request $request)
    {

        $query = Skill::with('service');
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'LIKE', "%{$search}%");
        }


        if ($request->filled('service_filter')) {
            $query->where('service_id', $request->service_filter);
        }
        $skills = $query->paginate(10);
        $services = Service::all();
        $formMode = 'store'; //

        return view('admin.skills.index', compact('skills', 'services', 'formMode'));
    }
    public function store(Request $request)
    {
//        dd($request->all(), $request->hasFile('image'));
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'service_id' => 'required',
        ]);

        $skill = new Skill();
        $skill->name = $request->name;
        $skill->service_id = $request->service_id;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $skill->image = $imageName;
        }

        $skill->save();
        return redirect()->route('admin.skills.index')->with('flash_message', 'Skill added!');
    }

public function edit($id)
{
    $skill = Skill::findOrFail($id);
    $services = Service::all();
    $formMode = 'edit';

    return view('admin.skills.edit', compact('skill','services','formMode'));
}
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'service_id' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        $skill = Skill::findOrFail($id);
        $skill->name = $request->name;
        $skill->service_id = $request->service_id;

        if ($request->hasFile('image')) {

            if ($skill->image && file_exists(public_path('images' . $skill->image))) {
                unlink(public_path('images' . $skill->image));
            }

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $skill->image = $imageName;
        }

        $skill->save();
        return redirect()->route('admin.skills.index')->with('flash_message', 'Skill updated!');
    }

    public function destroy($id)
    {

        $skill = Skill::findOrFail($id);
        $skill->delete();
        return redirect()->route('admin.skills.index')
            ->with('flash_message', 'Skill deleted successfully!');
    }
}
