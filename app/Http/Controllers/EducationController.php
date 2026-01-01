<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index(Request $request)
    {
        $query = Education::query();
        if ($request->filled('service_filter') && is_numeric($request->service_filter)) {
            $query->where('id', $request->service_filter);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('institution', 'LIKE', "%{$search}%")
                    ->orWhere('department', 'LIKE', "%{$search}%")
                    ->orWhere('degree', 'LIKE', "%{$search}%")
                    ->orWhere('period', 'LIKE', "%{$search}%");
            });
        }

        $educations = $query->orderBy('id', 'DESC')->get();
        return view('admin.education.index', compact('educations'));

    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'institution' => 'required|string|max:255',
            'period'      => 'required|string|max:255',
            'degree'      => 'required|string|max:255',
            'department'  => 'required|string|max:255',
        ]);

        Education::create($data);

        return redirect()->back()->with('flash_message', 'Education added successfully!');
    }
    public function destroy($id)
    {
        $education = Education::findOrFail($id);
        $education->delete();

        return redirect()->route('admin.education.index')
            ->with('flash_message', 'Education deleted successfully!');
    }
    public function update(Request $request, $id)
    {
        $education = Education::findOrFail($id);

        $data = $request->validate([
            'institution' => 'required|string|max:255',
            'period'      => 'required|string|max:255',
            'degree'      => 'required|string|max:255',
            'department'  => 'required|string|max:255',
        ]);

        $education->update($data);

        return redirect()->back()->with('flash_message', 'Education updated successfully!');
    }
}
