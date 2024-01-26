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
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);

        return redirect()->route('profile');
    }
}
