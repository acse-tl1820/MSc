<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chatroom;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Events\MessageSent;
use App\Models\VideoAction;
use App\Events\ChangeVideo;
use App\Events\VideoSync;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Broadcast;
use App\Events\UserJoined;
use App\Events\UserLeft;

class ChatRoomController extends Controller
{
    public function index()
    {
        $chatrooms = Chatroom::all();
        return view('dashboard', compact('chatrooms'));
    }

    public function create()
    {
        return view('chatroom.create');
    }

    public function store(Request $request)
    {
        $youtube_video_id = explode("?v=", $request->input('youtube_video_id'))[1];

        $chatroom = Chatroom::create([
            'name' => $request->input('name'),
            'user_id' => Auth::id(),
            'youtube_video_id' => $youtube_video_id,
        ]);

        return redirect()->route('chatroom.show', $chatroom);
    }

    public function show(Chatroom $chatroom)
    {
        $messages = $chatroom->messages()->get();

        return view('chatroom.show', compact('chatroom', 'messages'));
    }

    public function chatroomMessages(Chatroom $chatroom)
    {
        $messages = $chatroom->messages()->get();
        return response()->json($messages);
    }

    public function sendMessage()
    {
        $message = Message::create([
            'chatroom_id' => request()->input('chatroom_id'),
            'user_id' => Auth::id(),
            'message' => request()->input('message'),
        ]);
        broadcast(new MessageSent($message))->toOthers();
        return response()->json($message);
    }

    public function syncVideo()
    {
        $videoAction = new VideoAction();
        $videoAction->chatroom_id = request()->input('chatroom_id');
        $videoAction->user_id = Auth::id();
        $videoAction->action = request()->input('action');
        $videoAction->current_time = request()->input('current_time');

        broadcast(new VideoSync($videoAction))->toOthers();
        return $videoAction;
    }

    public function changeVideo()
    {
        $chatroom_id = request()->input('chatroom_id');
        $chatroom = Chatroom::find($chatroom_id)->update([
            'youtube_video_id' => request()->input('youtube_video_id'),
        ]);

        $chatroom = Chatroom::find($chatroom_id);

        broadcast(new ChangeVideo($chatroom))->toOthers();

        return $chatroom;
    }

    public function checkCurrentStatus(Chatroom $chatroom)
    {
        $chatroom_id = $chatroom->id;
        $status = Cache::get("status". $chatroom_id);
        if($status){
            return response()->json($status);
        }else{
            return response()->json(["msg" => "failure"]);
        }
    }

    public function saveCurrentStatus()
    {
        $videoAction = new VideoAction();
        $videoAction->chatroom_id = request()->input('chatroom_id');
        $videoAction->user_id = Auth::id();
        $videoAction->action = request()->input('action');
        $videoAction->current_time = request()->input('current_time');

        Cache::put("status". request()->input('chatroom_id'), $videoAction, 60);

        return request()->json($videoAction);
    }

    public function joinRoom(Request $request, $roomId)
    {
        $user = auth()->user();
        broadcast(new UserJoined($user, $roomId));

        return response()->json(['message' => 'User joined']);
    }

    public function leaveRoom(Request $request, $roomId)
    {
        $user = auth()->user();
        broadcast(new UserLeft($user, $roomId));

        return response()->json(['message' => 'User left']);
    }

}
