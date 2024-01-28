<?php

namespace App\Http\Controllers;

use App\Events\NewContentNotification;
use App\Events\NewMessage;
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

    public function getUserMessage($id){
        $messages = Messages::where(function($q) use($id) {
            $q->where('sender_id', Auth::user()->id);
            $q->where('receiver_id', $id);
             })
            ->oRwhere(function($q) use ($id){
            $q->where('receiver_id', Auth::user()->id);
            $q->where('sender_id', $id);
            })
            ->get();
        return response()->json(['data' => $messages]);
    }

    public function store(Request $request){
        $chat = Messages::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->receiver_id,
            'messages' => $request->messages,
        ]);

        event(new NewMessage($chat));
        return response()->json(['data' => $chat]);
    }

    public function search(Request $request){
        $query = $request->input('cari');
        $user = User::where('name', 'like', '%' . $query . '%')->get();
        return response()->json($user);
    }


}
