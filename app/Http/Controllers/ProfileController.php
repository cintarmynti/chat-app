<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        $user = User::where('id', Auth::user()->id)->first();
        return view('pages.profile.index', compact('user'));
    }

    public function user(){
        $user = User::find(Auth::user()->id);
        return response()->json(['data' => $user]);
    }

    public function update(Request $request){

        $user = User::find(Auth::user()->id);
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];

        if ($request->hasFile('image')) {
            // dd('masuk');
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
            $data['image_path'] = 'images/'.$imageName;
        }

        $user->update($data);

        return redirect()->route('profile');
    }

    public function imageProfile(){
        $user = User::find(Auth::user()->id);
        // dd($user);
        return response()->json($user);
    }
}
