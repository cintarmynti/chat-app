<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\group_members;
use App\Models\group_message;
use App\Models\Groups;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupChatController extends Controller
{
    // menampilkan halaman group
    public function index(){
        return view('pages.Group.index');
    }

    // menampilkan halaman membuat group
    public function create(){
        $user = User::where('id', '!=', Auth::user()->id)->get();
        return view('pages.Group.create', ['users' => $user]);
    }

    // menyimpan group ke dalam database
    public function store(Request $request){
        $request->validate([
            'group_name' => 'required|string|max:255',
            'desc' => 'nullable',
            'anggota' => 'required|array|min:2',
        ]);

        $group = new Groups();
        $group->group_name = $request->group_name;
        $group->desc = $request->desc;
        if ($request->hasFile('image')) {
            // dd('masuk');
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
            $group->image_group = 'images/'.$imageName;

        }
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

    // ini group list
    public function group(){
        $userId = Auth::user()->id;

        $groups = Groups::whereHas('members', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with(['chats' => function ($query) {
            $query->latest(); // Retrieve the latest chat for each group
        }])->get();


        foreach ($groups as $group) {
            $lastMessage = $group->chats->first();

            $lastGroupChat[] = [
                'group_id' => $group->id,
                'group_name' => $group->group_name,
                'last_message' => $lastMessage ? $lastMessage->content : "start a new chat",
                'last_chat_time' => $lastMessage ? Carbon::parse($lastMessage->created_at)->format('h:i A') : "",
                'image_group' => $group->image_group
            ];

        }


        return response()->json(['data' => $lastGroupChat]);

    }

    public function send(Request $request){
        $chat = group_message::create([
            'sender_id' => Auth::user()->id,
            'group_id' => $request->receiver_id,
            'content' => $request->messages,
        ]);

        $newChat = group_message::with('group','users')->where('id', $chat->id)->first();

        event(new NewMessage($newChat));
        return response()->json(['data' => $newChat]);
    }

    public function getGroupMessage($id){
        $group = group_message::with('group', 'users')->where('group_id', $id)->get();
        $group_id = Groups::find($id);


        foreach($group as $g){
            $g->format_created_at = Carbon::parse($g->created_at)->format('h:i A');
        }
        return response()->json(['data' => $group, 'group_id' => $group_id]);
    }

    public function anggota($id){
        $anggota = group_members::with('users')->where('group_id', $id)->get();
        return response()->json(['data' => $anggota]);
    }

    public function update(Request $request){
        $group = Groups::find($request->id);
        $data = [
            'group_name' => $request->group_name,
            'desc' => $request->desc
        ];

        if($request->hasFile('image_file')){
            $image = $request->file('image_file');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image -> storeAs('public/images', $imageName);
            $data['image_group'] = 'images/'.$imageName;
        }

        $group -> update($data);
        return redirect()->route('group');
    }

}
