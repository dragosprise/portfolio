<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderby('id','DESC')->get();
        return view('admin.users.index',compact('users'));
    }
    public function store(Request $request) {
        $data = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:6000',
            'name'  => 'required',
            'email'   => 'required',
            'password'  => 'required|min:6',

        ]);

        if($request->hasFile('image')){
            $fileName = time().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $fileName);
            $data['image'] = $fileName;
        }
        $data['password']=bcrypt($data['password']);
        User::create($data);
        return redirect()->back()->with('flash_message', 'User created successfully!');
    }
    public function destroy($id)
    {

        $user = User::findOrFail($id);


        $user->delete();


        return redirect()->route('users.index')
            ->with('flash_message', 'User deleted successfully!');
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:6000',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:6'
        ]);

        if($request->hasFile('image')){
            if ($user->image && file_exists(public_path('images/'.$user->image))) {
                unlink(public_path('images/'.$user->image));
            }

            $fileName = time().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $fileName);
            $data['image'] = $fileName;
        }

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);
        return redirect()->back()->with('flash_message', 'User updated successfully!');
    }
}
