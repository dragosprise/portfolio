<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
   public function edit(){
       $about = About::latest()->first();
       return view('admin.about.edit', compact(['about']));
}
    public function update(Request $request)
    {
        $about = About::latest()->first();

        $validated = $request->validate([
            'name'        => 'required|string',
            'email'       => 'required|email',
            'short_bio'   => 'nullable|string',
            'location'    => 'nullable|string',
            'description' => 'required|string',
            'cv'          => 'nullable|mimes:pdf|max:2048',
            'home_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:6000',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:6000',
        ]);

        $about->fill($validated);

        if($request->hasFile('home_image')){
            if ($about->home_image && file_exists(public_path('images/'.$about->home_image))) {
                unlink(public_path('images/'.$about->home_image));
            }

            $fileName = time().'_'.$request->home_image->getClientOriginalName();
            $request->home_image->move(public_path('images'), $fileName);
            $about->home_image = $fileName;
        }
        if($request->hasFile('banner_image')){
            if ($about->banner_image && file_exists(public_path('images/'.$about->banner_image))) {
                unlink(public_path('images/'.$about->banner_image));
            }

            $fileName = time().'_'.$request->banner_image->getClientOriginalName();
            $request->banner_image->move(public_path('images'), $fileName);
            $about->banner_image = $fileName;
        }
        if($request->hasFile('cv')){
            if ($about->cv && file_exists(public_path('pdf/'.$about->cv))) {
                unlink(public_path('pdf/'.$about->cv));
            }

            $fileName = time().'_'.$request->cv->getClientOriginalName();
            $request->cv->move(public_path('pdf'), $fileName);
            $about->cv = $fileName;
        }

        $about->save();

        return redirect()->route('about.edit')
            ->with('flash_message', 'Datele au fost salvate!');
    }

}
