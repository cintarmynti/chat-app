<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function index(){
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return view('pages.chat', compact('users'));
    }

    public function user(){
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return response()->json([['data' => $users]]);
    }



}
