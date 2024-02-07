<?php

namespace App\Http\Controllers;

use App\Models\group_members;
use App\Models\group_message;
use App\Models\Groups;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupChatController extends Controller
{
    public function index(){
        return view('pages.Group.index');
    }

    public function create(){
        $user = User::where('id', '!=', Auth::user()->id)->get();
        return view('pages.Group.create', ['users' => $user]);
    }

    public function store(Request $request){
        $request->validate([
            'group_name' => 'required|string|max:255',
            'desc' => 'nullable',
            'anggota' => 'required|array|min:2',
        ]);

        $group = new Groups();
        $group->group_name = $request->group_name;
        $group->desc = $request->desc;
        $group->save();

        foreach ($request->input('anggota') as $userId) {
            $member = new group_members();
            $member->user_id = $userId;
            $member->group_id = $group->id;
             $member->role = ($userId == Auth::user()->id) ? 0 : 1;
            $member->save();
        }

        return redirect()->route('group');
    }

    public function group(){
        $userId = Auth::user()->id;
        $group = Groups::whereHas('members', function($query) use ($userId){
            $query->where('user_id', $userId);
        })->get();

        return response()->json(['data' => $group]);
    }

    public function send(Request $request){
        $chat = group_message::create([
            'sender_id' => Auth::user()->id,
            'group_id' => $request->receiver_id,
            'content' => $request->messages,
        ]);

        // event(new NewMessage($chat));
        return response()->json(['data' => $chat]);
    }

    public function getGroupMessage($id){
        $group = group_message::with('group', 'users')->where('group_id', $id)->get();
        return response()->json(['data' => $group]);

    }
}
