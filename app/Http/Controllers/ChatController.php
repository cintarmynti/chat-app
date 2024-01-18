<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function index(){
        return view('pages.chat');
    }

    public function user(){
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return response()->json([['data' => $users]]);
    }

    public function getUser($id){
        $messages = Messages::where('sender_id', Auth::user()->id)->where('receiver_id', $id)->get();
        return response()->json(['data' => $messages]);
    }

    public function store(Request $request){
        $chat = Messages::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->receiver_id,
            'messages' => $request->messages,
        ]);

        return response()->json(['data' => $chat], 201);
    }


}
